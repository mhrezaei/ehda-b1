<?php

namespace App\Http\Controllers\Manage;

use App\Events\SendEmail;
use App\Events\SendSms;
use App\Events\UserAccountPublished;
use App\Events\UserPasswordManualReset;
use App\Http\Requests\Manage\CardSearchRequest;
use App\Models\Domain;
use App\Models\State;
use App\Models\User;
use App\Providers\AppServiceProvider;
use App\Traits\TahaControllerTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;


class CardsController extends Controller
{
	use TahaControllerTrait;

	public function __construct()
	{
		$this->middleware('can:cards');

		$this->page[0] = ['cards' , trans('manage.modules.cards')];
	}

	public function search(CardSearchRequest $request) //@TODO: INTACT!
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["search" , trans("people.cards.manage.search") , "search"] ;
		$db = User::first() ;

		//IF SEARCHED...
		if(isset($request->searched)) {
			$keyword = $request->keyword ;
			$model_data = User::where('card_status' , '!=' , '0')
					->where('name_first','like',"%{$keyword}%")
					->orWhere('name_last','like',"%{$keyword}%")
					->orWhere('code_melli','like',"%{$keyword}%")
					->orWhere('email','like',"%{$keyword}%")
					->orderBy('created_at' , 'desc')->paginate(50);

			return view('manage.cards.browse' , compact('page' , 'model_data' , 'db' , 'keyword'));
		}

		//IF JUST FORM...
		return view("manage.cards.search" , compact('page' , 'db'));

	}


	public function browse($request_tab = 'active')
	{
		//Prepar ation...
		$page = $this->page ;
		$page[1] = ["browse/".$request_tab , trans("people.cards.manage.$request_tab") , $request_tab] ;

		//Permission...
		switch($request_tab) {
			case 'active' :
				$permission = 'cards.browse' ;
				break;
//			case 'pending' :
//				$permission = 'cards.publish' ;
//				break;
			case 'bin':
				$permission = 'cards.bin' ;
				break;
			default :
				$permission = 'somethingImpossible' ;
		}
		if(!Auth::user()->can($permission))
			return view('errors.403');


		//Model...
		$model_data = User::selector('card',$request_tab)->orderBy('created_at' , 'desc')->paginate(50);
		$db = User::first() ;

		//View...
		return view("manage.cards.browse" , compact('page','model_data' , 'db'));

	}

	public function modalActions($card_id , $view_file)
	{

		//@TODO: Do something for checking the permission, despite the fact that everything will be checked at the save method.
		//@TODO: Reject if accessed without valid AJAX request
		if($card_id==0)
			return $this->modalBulkAction($view_file);

		$model = User::find($card_id) ;
		$view = "manage.cards.$view_file" ;
		$opt = [] ;

		//Particular Actions...
		switch($view_file) {
			case 'permits' :
				$opt['domains'] = Domain::orderBy('title')->get() ;
				break;

		}

		if(!$model) return view('errors.m410');
		if(!View::exists($view)) return view('errors.m404');

		return view($view , compact('model' , 'opt')) ;
	}

	private function modalBulkAction($view_file) //@TODO: INTACT!
	{
		$view = "manage.cards.$view_file-bulk" ;

		if(!View::exists($view)) return view('templates.say' , ['array'=>$view]); //@TODO: REMOVE THIS LINE
		if(!View::exists($view)) return view('errors.m404');

		return view($view) ;
	}

	public function create()
	{
		//Permission...
		if(!Auth::user()->can('cards.create'))
			return view('errors.410');

		//Preparetions...
		$page = $this->page ;
		$page[1] = ["cards/create" , trans('people.cards.manage.create') , ''];

		//Model...
		$model = new User() ;
		$states = State::get_combo() ;

		foreach(User::$donatable_organs as $donatable_organ) {
			$model->organs .= ' '.trans("people.organs.$donatable_organ");
		}
		$model->newsletter = 1 ;

		//View..
		return view('manage.cards.editor' , compact('page','model','states'));

	}

	public function editor($model_id=0)
	{

		//Permission...
		if(!Auth::user()->can('cards.edit'))
			return view('errors.410');

		//Preparetions...
		$page = $this->page ;
		$page[1] = ["cards/$model_id/edit" , trans('people.cards.manage.edit') , ''];

		//Model...
		$states = State::get_combo() ;
		$model = User::find($model_id) ;
		if(!$model or !$model->isCard())
		return view('errors.404');

		//View...
		return view('manage.cards.editor' , compact('page' , 'model' , 'states'));

	}

	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	public function save(Requests\Manage\CardSaveRequest $request)
	{
		//Preparations...
		$data = $request->toArray() ;
		$user = Auth::user() ;

		//Processing donatable organs...
		$data['organs'] = null ;
		foreach(User::$donatable_organs as $donatable_organ) {
			if($data['_'.$donatable_organ])
				$data['organs'] .= ' '.trans("people.organs.$donatable_organ").' ' ;
		}
		if(!trim($data['organs']))
			return $this->jsonFeedback(trans('validation.javascript_validation.organs'));

		//Processing dates...
		$carbon = new Carbon($request->birth_date);
		$data['birth_date'] = $carbon->toDateTimeString() ;

		//Processing passwords and a few more things...
		if(!$data['id']) {
			$data['password'] = Hash::make(strrev($data['code_melli']));
			$data['password_force_change'] = 1 ;
			$data['card_registered_at'] = Carbon::now()->toDateTimeString() ;
			$data['card_status'] = 8 ;
			if($data['_submit'] == 'print')
				$data['card_print_status'] = 1 ;
		}

		//Save and Return...
		$saved = User::store($data);
		return $this->jsonAjaxSaveFeedback($saved , [
			'success_refresh' => true ,
		]);

	}

	public function change_password(Requests\Manage\CardChangePasswordRequest $request)
	{
		$model = User::find($request->id) ;
		$model->password = Hash::make($request->password) ;
		$model->password_force_change = 1 ;
		$is_saved = $model->save();

		if($is_saved and $request->sms_notify)
			;//@TODO: Call the event
			//Event::fire(new CardPasswordManualReset($model , $request->password));

		return $this->jsonAjaxSaveFeedback($is_saved);

	}
	public function publish(Request $request) //@TODO: INTACT!
	{
		if(!Auth::user()->can('cards.publish')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$model = User::find($request->id) ;
		if($model->card_status<0)
			return $this->jsonFeedback() ;

		$model->published_at = Carbon::now()->toDateTimeString() ;
		$model->published_by = Auth::user()->id ;
		$model->card_status = 8 ;
		$is_saved = $model->save();

		if($is_saved)
			;//@TODO: Call the event
//			Event::fire(new CardAccountPublished($model));

		return $this->jsonAjaxSaveFeedback($is_saved , [
			'success_refresh' => true ,
		]);

	}

	public function bulk_publish(Request $request) //@TODO: INTACT!
	{
		if(!Auth::user()->can('cards.publish')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		//Action...
		$ids = $request->ids ;
		if(!is_array($ids))
			$ids = explode(',',$ids);

		$done = User::whereIn('id',$ids)->where('card_status' , '>' , '0')->where('card_status' , '<' , '8')->update([
				'published_at' => Carbon::now()->toDateTimeString() ,
				'published_by' => Auth::user()->id ,
				'card_status' => 8 ,
		]);

		//Feedback...
		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);

		//@TODO: Event
	}

	public function soft_delete(Request $request) //@TODO: INTACT!
	{
		if(!Auth::user()->can('cards.delete')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;
		if($request->id == Auth::user()->id) return $this->jsonFeedback();

		$model = User::find($request->id) ;
		$done = $model->cardDelete();

		return $this->jsonAjaxSaveFeedback($done , [
			'success_refresh' => true ,
		]);

	}

	public function bulk_soft_delete(Request $request) //@TODO: INTACT!
	{
		if(!Auth::user()->can('cards.delete')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$ids = explode(',',$request->ids);
		foreach($ids as $id) {
			$model = User::find($id) ;
			if($model and $id != Auth::user()->id)
				$done = $model->cardDelete() ;
		}

		return $this->jsonAjaxSaveFeedback($done , [
			'success_refresh' => true ,
		]);
	}

	public function undelete(Request $request) //@TODO: INTACT!
	{
		if(!Auth::user()->can('cards.bin')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$model = User::find($request->id) ;
		$done = $model->cardUndelete() ;

		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);

	}

	public function bulk_undelete(Request $request) //@TODO: INTACT!
	{
		if(!Auth::user()->can('cards.bin'))
			return $this->jsonFeedback(trans('validation.http.Eror403'));

		$ids = explode(',', $request->ids);
		foreach($ids as $id) {
			$model = User::find($id);
			if($model and $id != Auth::user()->id)
				$done = $model->cardUndelete();
		}

		return $this->jsonAjaxSaveFeedback($done, ['success_refresh' => true,]);
	}

	public function hard_delete(Request $request) //@TODO: INTACT!
	{
		if(!Auth::user()->isDeveloper()) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$model = User::find($request->id) ;
		if(!$model or $model->card_status>0)
			return $this->jsonFeedback(trans('validation.http.Eror403'));

		$done = $model->cardHardDelete() ;

		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);

	}

	public function bulk_hard_delete(Request $request) //@TODO: INTACT!
	{
		if(!Auth::user()->isDeveloper()) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$ids = explode(',', $request->ids);
		foreach($ids as $id) {
			$model = User::find($id);
			if($model and $model->card_status<0 and $id != Auth::user()->id)
				$done = $model->cardHardDelete();
		}

		return $this->jsonAjaxSaveFeedback($done, [
				'success_refresh' => true,
		]);


	}

	public function permits(Request $request) //@TODO: INTACT!
	{
		$data = $request->toArray() ;
		$allowed_domains = '|' ;
		$allowed_permits = [] ;
		$model = User::find($request->id) ;

		//Security...
		if(!Auth::user()->can('cards.permits'))
			return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		//Permits...
		foreach($data as $pointer => $item) {
			if(!str_contains($pointer,'permit') or !$data[$pointer])
				continue;

			$pointer = str_replace('permit','',$pointer) ;
			$pointer = str_replace('_','.',$pointer) ;
			array_push($allowed_permits,$pointer);
		}
		$is_saved_permits = $model->setPermits($allowed_permits) ;

		//Domains...
		$domains = Domain::all() ;
		foreach($domains as $domain) {
			$pointer = "domain".$domain->id ;
			if($data[$pointer])
				$allowed_domains .= $domain->slug.'|';
		}

		$is_saved_domains = $model->setDomains($allowed_domains) ;

		//Return...
		return $this->jsonAjaxSaveFeedback($is_saved_domains and $is_saved_permits);
	}

	public function sms(Requests\Manage\CardSendMessage $request) //@TODO: INTACT!
	{
		$card = User::find($request->id) ;
		if(!$card)
			return $this->jsonFeedback();

		$is_sent = Event::fire(new SendSms([$card->tel_mobile] , $request->message));

		return $this->jsonAjaxSaveFeedback($is_sent) ;
	}

	public function bulk_sms(Requests\Manage\CardSendMessage $request) //@TODO: INTACT!
	{

		$done = true ; //@TODO: Write the event!

		return $this->jsonAjaxSaveFeedback($done) ;
	}

	public function email(Requests\Manage\CardSendMessage $request) //@TODO: INTACT!
	{
		$card = User::find($request->id) ;
		if(!$card)
			return $this->jsonFeedback();

		$is_sent = Event::fire(new SendEmail([$card->email] , $request->title , $request->message));

		return $this->jsonAjaxSaveFeedback($is_sent) ;
	}

	public function bulk_email(Requests\Manage\CardSendMessage $request) //@TODO: INTACT!
	{

		$done = true ; //@TODO: Write the event!

		return $this->jsonAjaxSaveFeedback($done) ;
	}

}
