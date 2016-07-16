<?php

namespace App\Http\Controllers\Manage;

use App\Models\State;
use App\Models\Volunteer;
use App\Traits\TahaControllerTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
		$model_data = Volunteer::selector($request_tab)->orderBy('created_at' , 'desc')->get();

		//View...
		return view('manage.volunteers.browse' , compact('page','model_data'));

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

		//@TODO: Delete User Button

	}

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
}
