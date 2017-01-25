<?php

namespace App\Http\Controllers\Manage;

use App\Events\SendEmail;
use App\Events\SendSms;
use App\Events\UserAccountPublished;
use App\Events\UserPasswordManualReset;
use App\Http\Requests\Manage\CardSearchRequest;
use App\Models\Domain;
use App\Models\Post;
use App\Models\Printer;
use App\Models\Printing;
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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;


class PrintingsController extends Controller
{
	use TahaControllerTrait;

	public function __construct()
	{
		$this->middleware('Can:cards.print');

		$this->page[0] = ['cards' , trans('manage.modules.cards')];
	}


	public function browse($request_tab = 'under_any_action' , $event_id = 0 , $user_id = 0 , $volunteer_id = 0)
	{
		//Preparation...
		$page = $this->page ;

		if(!in_array($request_tab , ['under_any_action' , 'pending' , 'under_print' , 'under_verification' , 'under_dispatch' , 'under_delivery' , 'archive' , 'bin']))
			return view('errors.404');

		$page[1] = ['printings/' , trans('people.printing') , ''] ;

		//Model...
		$model_data = Printing::selector([
			'criteria' => $request_tab,
			'event_id' => $event_id ,
			'user_id' => $user_id,
			'volunteer_id' => $volunteer_id,
		])->orderBy('updated_at' , 'desc')->paginate(50);

		$db = new Printing();

		//View...
		return view("manage.printings.browse" , compact('page','model_data' , 'db' , 'volunteer' , 'volunteer_id' , 'event_id' ,'user_id'));

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
			case 'print' :
				$opt['print'] = User::virtualPrintTable() ;
				break;
		}

		if(!$model) return view('errors.m410');
		if(!View::exists($view)) return view('errors.m404');

		return view($view , compact('model' , 'opt')) ;
	}

	private function modalBulkAction($view_file)
	{
		$view = "manage.cards.$view_file-bulk" ;

		if(!View::exists($view)) return view('templates.say' , ['array'=>$view]); //@TODO: REMOVE THIS LINE
		if(!View::exists($view)) return view('errors.m404');

		if($view_file == 'print')
			$print = User::virtualPrintTable() ;


		return view($view , compact('print')) ;
	}

	private function editorForVolunteers($id , $page)
	{
		$model = User::find($id);
		if(!$model->isVolunteer())
			return view('errors.410');

		if(!$model->isCard()) {
			foreach(User::$donatable_organs as $donatable_organ) {
				$model->organs .= ' ' . trans("people.organs.$donatable_organ");
			}
		}

		return view('manage.cards.editor-volunteer' , compact('model','page'));

	}

	public function create($volunteer_id = 0)
	{
		//Permission...
		if(!Auth::user()->can('cards.create'))
			return view('errors.403');

		//Preparetions...
		$page = $this->page ;
		$page[1] = ["cards/create" , trans('people.cards.manage.create') , ''];

		//If for Volunteer...
		if($volunteer_id)
			return $this->editorForVolunteers($volunteer_id , $page) ;

		//Model...
		$model = new User() ;
		$states = State::get_combo() ;

		foreach(User::$donatable_organs as $donatable_organ) {
			$model->organs .= ' '.trans("people.organs.$donatable_organ");
		}
		$model->newsletter = 1 ;


		$all_events = Post::selector('event' , 'auto')->orderBy('published_at' , 'desc')->get() ;
		$events = [] ;
		foreach($all_events as $event) {
			if($event->meta('can_register_card')) {
				array_push($events , $event);
			}
		}
		$model->event_id = Session::get('user_favourite_event',0);

		//View..
		return view('manage.cards.editor' , compact('page','model','states','events'));

	}

	public function editor($model_id=0)
	{

		//Permission...
		if(!Auth::user()->can('cards.edit'))
			return view('errors.410');

		//Preparetions...
		$page = $this->page ;

		//Model...
		$states = State::get_combo() ;
		$model = User::find($model_id) ;
		if(!$model)
			return view('errors.410');

		//Page..
		if($model->isCard()) {
			$page[1] = ["cards/$model_id/edit", trans('people.cards.manage.edit'), ''];
		}
		else {
			$page[1] = ["cards/$model_id/edit", trans('people.cards.manage.create'), ''];
		}


		if($model->isActiveVolunteer() and !Auth::user()->can('volunteers.edit'))
			return $this->editorForVolunteers($model->id , $page);

		//View...
		return view('manage.cards.editor' , compact('page' , 'model' , 'states'));

	}

	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/


	public function delete(Request $request)
	{
		if(!Auth::user()->can('cards.delete')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;
		if($request->id == Auth::user()->id) return $this->jsonFeedback();

		$model = User::find($request->id) ;
		$done = $model->cardDelete();

		return $this->jsonAjaxSaveFeedback($done , [
			'success_refresh' => true ,
		]);

	}

	public function bulk_delete(Request $request)
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


	public function single_print(Requests\Manage\CardPrintRequest $request)
	{
		//Preparations...
		$request->status += 0 ;
		$user = User::find($request->id);

		if(!$user or !$user->isCard())
			return $this->jsonFeedback('Error #1');

		//Processing Printer table...
		if($request->status == 2) {
			$printer = new Printer() ;
			$printer->user_id = $user->id ;
			$printer->name_full = $user->fullName() ;
			$printer->name_father = $user->say('name_father') ;
			$printer->code_melli = $user->say('code_melli') ;
			$printer->birth_date = $user->say('birth_date_on_card') ;
			$printer->registered_at = $user->say('register_date_on_card') ;
			$printer->card_no = $user->say('card_no') ;
			$printer->save() ;
		}
		else {
			Printer::where('user_id',$user->id)->delete();
		}

		//Updating Status...
		$ok = User::bulkSet($request->id , [
			'card_print_status' => $request->status ,
		]);

		//Return...
		return $this->jsonAjaxSaveFeedback($ok , [
				'success_refresh' => '1' ,
		]);

	}

	public function bulk_print(Requests\Manage\CardPrintRequest $request)
	{
		//Preparations...
		$request->status += 0 ;

		//Processing Printer table...
		$ids = explode(',',$request->ids);
		if($request->status == 2) {
			foreach($ids as $id) {
				$user = User::find($id) ;
				if(!$user) continue ;
				$printer = new Printer() ;
				$printer->user_id = $user->id ;
				$printer->name_full = $user->fullName() ;
				$printer->name_father = $user->say('name_father') ;
				$printer->code_melli = $user->say('code_melli') ;
				$printer->birth_date = $user->say('birth_date_on_card') ;
				$printer->registered_at = $user->say('register_date_on_card') ;
				$printer->card_no = $user->say('card_no') ;
				$printer->save() ;
			}
		}
		else {
			Printer::whereIn('user_id',$ids)->delete();
		}

		//Updating Status...
		$ok = User::bulkSet($request->ids , [
			'card_print_status' => $request->status ,
		]);

		//Return...
		return $this->jsonAjaxSaveFeedback($ok , [
			'success_refresh' => '1' ,
		]);

	}

	public function add_to_print(Requests\Manage\CardAddToPrintRequest $request)
	{
		$user = User::findBySlug($request->code_melli , 'code_melli') ;

		if(!$user or !$user->isCard())
			return $this->jsonFeedback() ;


		if($request->_submit == 'edit')
		return $this->jsonFeedback(1,[
				'ok' => 1 ,
				'message' => trans('people.cards.manage.edit').'... ' ,
				'redirect' => url("manage/cards/$user->id/edit") ,
				'redirectTime' => 1 ,
			]);


		if($user->card_print_status > 0 and $user->card_print_status < 4)
			return $this->jsonFeedback( trans('people.cards.manage.print_already_requested') , [
				'refresh' => true ,
			] ) ;

		$user->card_print_status = 1 ;
		$user->event_id = $request->event_id ;
		$ok = $user->save() ;

		//Saving favourite event...
		$request->session()->put('user_favourite_event' , $request->event_id);


		return $this->jsonSaveFeedback( $ok , [
			'success_refresh' => true ,
		]);



	}

}
