<?php

namespace App\Http\Controllers\Manage;

use App\models\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class ManageController extends Controller
{
	private $page = array() ;

	public function __construct()
	{
		$this->page[0] = ['index' , trans('manage.modules.index')] ;
	}


	public function index()
	{
		//Preparetions...
		$page = $this->page ;

		return view('manage.index.0',compact('page'));
	}

	public static function topbarCreateMenu()
	{
		$branches = Branch::all() ;
		$array = [] ;
		$sep = false ;

		foreach($branches as $branch) {
			if(Auth::user()->can($branch->slug.".create"))
				array_push($array , [
						"manage/posts/$branch->slug/create" ,
						trans('manage.global.create_in' , ['thing'=>$branch->title(0)]),
						$branch->icon ,
				]) ;
		}

		//Other things...
		if(Auth::user()->can('cards.create') or Auth::user()->can('volunteers.create'))
			array_push($array ,['-'] );

		array_push($array , [
				"manage/cards/create" ,
				trans('people.cards.manage.create') ,
				'credit-card' ,
				Auth::user()->can('cards.create')
		]);
		array_push($array , [
				"manage/volunteers/create" ,
				trans('people.volunteers.manage.create') ,
				'child' ,
				Auth::user()->can('volunteers.create')
		]);

		return $array ;

	}



}
