<?php

namespace App\Http\Controllers\Manage;

use App\Models\State;
use App\Traits\TahaControllerTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VolunteersController extends Controller
{
	use TahaControllerTrait;

	public function __construct()
	{
		$this->middleware('can:volunteers');

		$this->page[0] = ['volunteers'];
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
			if(!Auth::user()->can('volunteers:create')) return view('errors.403'); //@TODO: don't forget to do this on save!
			$page[1] = ['create' , trans('people.volunteers.manage.create') , ''] ;

			$random_password = Str::random(10) ;
			return view($view , compact('page' , 'random_password' , 'states'));
		}

	}
}
