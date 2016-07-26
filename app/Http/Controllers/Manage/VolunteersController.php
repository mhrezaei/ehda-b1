<?php

namespace App\Http\Controllers\Manage;

use App\Events\SendEmail;
use App\Events\SendSms;
use App\Events\VolunteerAccountPublished;
use App\Events\VolunteerPasswordManualReset;
use App\Models\Domain;
use App\Models\State;
use App\Models\Volunteer;
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
		$this->middleware('can:volunteers');

		$this->page[0] = ['volunteers'];
	}

	public function browse($request_tab = 'active')
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["browse/".$request_tab , trans("people.volunteers.manage.$request_tab") , $request_tab] ;

		//Model...
		$model_data = Volunteer::selector($request_tab)->orderBy('created_at' , 'desc')->paginate(50);

		//View...
		return view('manage.volunteers.browse' , compact('page','model_data'));

	}

	public function modalActions($volunteer_id , $view_file)
	{

		//@TODO: Do something for checking the permission, despite the fact that everything will be checked at the save method.
		//@TODO: Reject if accessed without valid AJAX request
		$model = Volunteer::withTrashed()->find($volunteer_id) ;
		$view = "manage.volunteers.$view_file" ;

		//Particular Actions...
		switch($view_file) {
			case 'permits' :
				$opt['domains'] = Domain::orderBy('title')->get() ;
				break;

		}

		if(!$model) return view('errors.m410');
		if(!View::exists($view)) return view('templates.say' , ['array'=>$view]); //@TODO: REMOVE THIS LINE
		if(!View::exists($view)) return view('errors.m404');

		$opt['random_password'] = Str::random(10) ;


		return view($view , compact('model' , 'opt')) ;
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

			$model = Volunteer::withTrashed()->find($model_id);
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

		if($request->id) {
			$data['updated_by'] = $user->id ;
		}
		else {
			$data['created_by'] = $user->id ;
			$data['password'] = Hash::make($data['password']);
			$data['password_force_change'] = 1 ;
			if($user->can('volunteers.publish')) {
				$data['published_at'] = Carbon::now()->toDateTimeString() ;
				$data['published_by'] = $user->id ;
			}
		}

		//TODO: unique code_melli , unique email ,

		//Save and Return...
		$saved = Volunteer::store($data);
		return $this->jsonSaveFeedback($saved , [

		]);

		// return $this->jsonFeedback($data['birth_date']);

	}

	public function change_password(Requests\Manage\VolunteerChangePasswordRequest $request)
	{
		$model = Volunteer::find($request->id) ;
		$model->password = Hash::make($request->password) ;
		$model->password_force_change = true ;
		$is_saved = $model->save();

		if($is_saved and $request->sms_notify)
			Event::fire(new VolunteerPasswordManualReset($model , $request->password));

		return $this->jsonAjaxSaveFeedback($is_saved);

	}
	public function publish(Request $request)
	{
		$model = Volunteer::find($request->id) ;
		$model->published_at = Carbon::now()->toDateTimeString() ;
		$model->published_by = Auth::user()->id ;
		$is_saved = $model->save();

		if($is_saved)
			Event::fire(new VolunteerAccountPublished($model));

		return $this->jsonAjaxSaveFeedback($is_saved , [
			'success_refresh' => true ,
		]);

	}

	public function soft_delete(Request $request)
	{
		if(!Auth::user()->can('volunteers.delete')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$model = Volunteer::find($request->id) ;
		$done = $model->delete();

		return $this->jsonAjaxSaveFeedback($done , [
			'success_refresh' => true ,
		]);

	}

	public function undelete(Request $request)
	{
		if(!Auth::user()->can('volunteers.bin')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$model = Volunteer::withTrashed()->find($request->id) ;
		$done = $model->restore();

		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);

	}


	public function hard_delete(Request $request)
	{
		if(!Auth::user()->can('volunteers.bin')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$model = Volunteer::withTrashed()->find($request->id) ;
		if(!$model->trashed()) return $this->jsonFeedback(trans('validation.http.Eror403'));
		$done = $model->forceDelete();

		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);

	}

	public function permits(Request $request)
	{
		$data = $request->toArray() ;
		$allowed_domains = [] ;
		$allowed_permits = [] ;
		$model = Volunteer::find($request->id) ;

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
				array_push($allowed_domains , $domain->id);
		}

		$is_saved_domains = $model->setDomains($allowed_domains) ;

		//Return...
		return $this->jsonAjaxSaveFeedback($is_saved_domains and $is_saved_permits);
	}

	public function sms(Requests\Manage\VolunteerSendMessage $request)
	{
		$volunteer = Volunteer::find($request->id) ;
		if(!$volunteer)
			return $this->jsonFeedback();

		$is_sent = Event::fire(new SendSms([$volunteer->tel_mobile] , $request->message));

		return $this->jsonAjaxSaveFeedback($is_sent) ;
	}

	public function email(Requests\Manage\VolunteerSendMessage $request)
	{
		$volunteer = Volunteer::find($request->id) ;
		if(!$volunteer)
			return $this->jsonFeedback();

		$is_sent = Event::fire(new SendEmail([$volunteer->email] , $request->message));

		return $this->jsonAjaxSaveFeedback($is_sent) ;
	}

}
