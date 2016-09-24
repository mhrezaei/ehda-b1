<?php

namespace App\Http\Controllers\Manage;

use App\Events\SendEmail;
use App\Events\SendSms;
use App\Events\UserAccountPublished;
use App\Events\UserPasswordManualReset;
use App\Http\Requests\Manage\VolunteerSearchRequest;
use App\models\Branch;
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


class VolunteersController extends Controller
{
	use TahaControllerTrait;

	public function __construct()
	{
		$this->middleware('Can:volunteers');

		$this->page[0] = ['volunteers' , trans('manage.modules.volunteers')];
	}

	public function search(VolunteerSearchRequest $request)
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["search" , trans("people.volunteers.manage.search") , "search"] ;
		$db = User::first() ;

		//IF SEARCHED...
		$keyword = $request->keyword ;
		if(isset($request->searched)) {
			$model_data = User::where('volunteer_status' , '!=' , '0')->whereRaw(User::searchRawQuery($keyword,User::$cards_search_fields))->orderBy('volunteer_registered_at' , 'desc')->paginate(50);
			return view('manage.volunteers.browse' , compact('page' , 'model_data' , 'db' , 'keyword'));
		}

		//IF JUST FORM...
		return view("manage.volunteers.search" , compact('page' , 'db'));

	}


	public function browse($request_tab = 'active')
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["browse/".$request_tab , trans("people.volunteers.manage.$request_tab") , $request_tab] ;

		//Permission...
		switch($request_tab) {
			case 'active' :
				$permission = 'volunteers' ;
				break;
			case 'pending' :
				$permission = 'volunteers.publish' ;
				break;
			case 'care' :
				$permission = 'volunteers.edit' ;
				break;
			case 'examining' :
				$permission = 'volunteers.publish' ;
				break;
			case 'bin':
				$permission = 'volunteers.bin' ;
				break;
			default :
				$permission = 'somethingImpossible' ;
		}
		if(!Auth::user()->can($permission))
			return view('errors.403');


		//Model...
		$model_data = User::selector('volunteer',$request_tab)->orderBy('created_at' , 'desc')->paginate(50);
		$db = User::first() ;

		//View...
		return view("manage.volunteers.browse" , compact('page','model_data' , 'db'));

	}

	public function modalActions($volunteer_id , $view_file)
	{

		//@TODO: Do something for checking the permission, despite the fact that everything will be checked at the save method.
		//@TODO: Reject if accessed without valid AJAX request
		if($volunteer_id==0)
			return $this->modalBulkAction($view_file);

		$model = User::find($volunteer_id) ;
		$view = "manage.volunteers.$view_file" ;
		$opt = [] ;

		//Particular Actions...
		switch($view_file) {
			case 'permits' :
				$opt['domains'] = Domain::orderBy('title')->get()->toArray() ;
				$opt['branches'] = Branch::orderBy('plural_title')->get() ;

				array_unshift($opt['domains'] , [
					'slug' => 'global' ,
					'title' => trans('posts.manage.global')
				]);
				break;

			case 'care_review' :
				$model->changes = json_decode($model->unverified_changes) ;
				$states = State::get_combo() ;
				break;

		}

		if(!$model) return view('errors.m410');
		if(!View::exists($view)) return view('errors.m404');

		return view($view , compact('model' , 'opt' , 'states')) ;
	}

	private function modalBulkAction($view_file)
	{
		$view = "manage.volunteers.$view_file-bulk" ;

		if(!View::exists($view)) return view('templates.say' , ['array'=>$view]); //@TODO: REMOVE THIS LINE
		if(!View::exists($view)) return view('errors.m404');

		return view($view) ;
	}


	public function editor($model_id=0)
	{
		//Preparation...
		$page = $this->page ;
		$view = 'manage.volunteers.editor' ;

		//Models...
		$states = State::get_combo() ;

		//View...
		if($model_id==0) {
			if(!Auth::user()->can('volunteers:create')) return view('errors.403');
			$page[1] = ['create' , trans('people.volunteers.manage.create') , ''] ;

			$random_password = Str::random(10) ;
			return view($view , compact('page' , 'random_password' , 'states'));
		}
		else {
			if(!Auth::user()->can('volunteers:edit')) return view('errors.403');
			$page[1] = ['edit' , trans('people.volunteers.manage.edit') , ''] ;

			$model = User::find($model_id);
			if(!$model) return view('errors.410');
			return view($view , compact('page' , 'states' , 'model'));
		}

	}

	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	public function save(Requests\Manage\VolunteerSaveRequest $request)
	{
		//Normalization...
		$data = $request->toArray() ;
		$user = Auth::user() ;

		$carbon = new Carbon($request->birth_date);
		$data['birth_date'] = $carbon->toDateTimeString() ; //TODO: No Age Validation?

		if(!$request->id) {
			$data['password'] = Hash::make($data['password']);
			$data['password_force_change'] = 1 ;
			$data['volunteer_registered_at'] = Carbon::now()->toDateTimeString() ;
			if($user->can('volunteers.publish')) {
				$data['volunteer_status'] = 8 ;
				$data['published_at'] = Carbon::now()->toDateTimeString() ;
				$data['published_by'] = $user->id ;
			}
			else
				$data['volunteer_status'] = 3 ;
		}

		//Save and Return...
		$saved = User::store($data);
		return $this->jsonAjaxSaveFeedback($saved , [
			'success_refresh' => true ,
		]);

		// return $this->jsonFeedback($data['birth_date']);

	}

	public function change_password(Requests\Manage\VolunteerChangePasswordRequest $request)
	{
		$model = User::find($request->id) ;
		$model->password = Hash::make($request->password) ;
		$model->password_force_change = 1 ;
		$is_saved = $model->save();

		if($is_saved and $request->sms_notify)
			;//@TODO: Call the event
			//Event::fire(new VolunteerPasswordManualReset($model , $request->password));

		return $this->jsonAjaxSaveFeedback($is_saved);

	}
	public function publish(Request $request)
	{
		if(!Auth::user()->can('volunteers.publish')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$model = User::find($request->id) ;
		if($model->volunteer_status<0)
			return $this->jsonFeedback() ;

		$model->published_at = Carbon::now()->toDateTimeString() ;
		$model->published_by = Auth::user()->id ;
		$model->volunteer_status = 8 ;
		$is_saved = $model->save();

		if($is_saved)
			;//@TODO: Call the event
//			Event::fire(new VolunteerAccountPublished($model));

		return $this->jsonAjaxSaveFeedback($is_saved , [
			'success_refresh' => true ,
		]);

	}

	public function bulk_publish(Request $request)
	{
		if(!Auth::user()->can('volunteers.publish')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		//Action...
		$ids = $request->ids ;
		if(!is_array($ids))
			$ids = explode(',',$ids);

		$done = User::whereIn('id',$ids)->where('volunteer_status' , '>' , '0')->where('volunteer_status' , '<' , '8')->update([
				'published_at' => Carbon::now()->toDateTimeString() ,
				'published_by' => Auth::user()->id ,
				'volunteer_status' => 8 ,
		]);

		//Feedback...
		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);

		//@TODO: Event
	}

	public function soft_delete(Request $request)
	{
		if(!Auth::user()->can('volunteers.delete')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;
		if($request->id == Auth::user()->id) return $this->jsonFeedback();

		$model = User::find($request->id) ;
		$done = $model->volunteerDelete();

		return $this->jsonAjaxSaveFeedback($done , [
			'success_refresh' => true ,
		]);

	}

	public function bulk_soft_delete(Request $request)
	{
		if(!Auth::user()->can('volunteers.delete')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$ids = explode(',',$request->ids);
		foreach($ids as $id) {
			$model = User::find($id) ;
			if($model and $id != Auth::user()->id)
				$done = $model->volunteerDelete() ;
		}

		return $this->jsonAjaxSaveFeedback($done , [
			'success_refresh' => true ,
		]);
	}

	public function undelete(Request $request)
	{
		if(!Auth::user()->can('volunteers.bin')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$model = User::find($request->id) ;
		$done = $model->volunteerUndelete() ;

		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);

	}

	public function bulk_undelete(Request $request)
	{
		if(!Auth::user()->can('volunteers.bin'))
			return $this->jsonFeedback(trans('validation.http.Eror403'));

		$ids = explode(',', $request->ids);
		foreach($ids as $id) {
			$model = User::find($id);
			if($model and $id != Auth::user()->id)
				$done = $model->volunteerUndelete();
		}

		return $this->jsonAjaxSaveFeedback($done, ['success_refresh' => true,]);
	}

		public function hard_delete(Request $request)
	{
		if(!Auth::user()->isDeveloper()) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$model = User::find($request->id) ;
		if(!$model or $model->volunteer_status>0)
			return $this->jsonFeedback(trans('validation.http.Eror403'));

		$done = $model->volunteerHardDelete() ;

		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);

	}

	public function bulk_hard_delete(Request $request)
	{
		if(!Auth::user()->isDeveloper()) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$ids = explode(',', $request->ids);
		foreach($ids as $id) {
			$model = User::find($id);
			if($model and $model->volunteer_status<0 and $id != Auth::user()->id)
				$done = $model->volunteerHardDelete();
		}

		return $this->jsonAjaxSaveFeedback($done, [
				'success_refresh' => true,
		]);


	}

	public function permits(Request $request)
	{
		$data = $request->toArray() ;
		$allowed_domains = '|' ;
		$allowed_permits = [] ;
		$model = User::find($request->id) ;

		//Security...
		if(!Auth::user()->can('volunteers.permits'))
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

	public function sms(Requests\Manage\VolunteerSendMessage $request)
	{
		$volunteer = User::find($request->id) ;
		if(!$volunteer)
			return $this->jsonFeedback();

		$is_sent = Event::fire(new SendSms([$volunteer->tel_mobile] , $request->message));

		return $this->jsonAjaxSaveFeedback($is_sent) ;
	}

	public function bulk_sms(Requests\Manage\VolunteerSendMessage $request)
	{

		$done = true ; //@TODO: Write the event!

		return $this->jsonAjaxSaveFeedback($done) ;
	}

	public function email(Requests\Manage\VolunteerSendMessage $request)
	{
		$volunteer = User::find($request->id) ;
		if(!$volunteer)
			return $this->jsonFeedback();

		$is_sent = Event::fire(new SendEmail([$volunteer->email] , $request->title , $request->message));

		return $this->jsonAjaxSaveFeedback($is_sent) ;
	}

	public function bulk_email(Requests\Manage\VolunteerSendMessage $request)
	{
		$done = true ; //@TODO: Write the event!

		return $this->jsonAjaxSaveFeedback($done) ;
	}

	public function care_review(Requests\Manage\VolunteerCareRequest $request)
	{
		$model = User::find($request->id);
		if(!$model or !$model->isVolunteer())
			return $this->jsonFeedback(trans('validation.http.Eror404'));

		//If Reject...
		if($request->_submit == 'reject') {
			$model->unverified_flag = -1 ;
			$model->meta('edit_reject_notice' , $request->reject_reason);
			$ok = $model->save();

			return $this->jsonAjaxSaveFeedback($ok , [
				'success_refresh' => 1 ,
			]);
		}

		//If Normal Save...
		$data = $request->toArray() ;
		$data['unverified_flag'] = 0 ;
		$data['unverified_changes'] = null ;
		$ok = User::store($data , ['reject_reason']) ;
		if($ok)
			$model->meta('edit_reject_notice' , null);

		return $this->jsonAjaxSaveFeedback($ok , [
				'success_refresh' => 1 ,
		]);

	}
}
