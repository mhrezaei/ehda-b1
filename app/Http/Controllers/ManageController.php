<?php

namespace App\Http\Controllers;

use App\Providers\PrivilegeServiceProvider;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class ManageController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function show($method)
	{
		if(!method_exists($this,$method)) return view('errors.404');
		if(!PrivilegeServiceProvider::check_role($method)) return view('errors.403');

		return $this->$method() ;
	}

	public function auth() //@TODO: Remove this method and its route at Production
	{
		//in...
		$user = Auth::user() ;
		$output = $user ;

		//here...
//		$command = ['cards.*' , 'volunteers.add,new,edit'] ;
//		$user->setPermits($command) ;
		$output = $user->getPermits() ;

		$output = $user->can('volunteers') ;

		//out...
		return view('templates.say')->with(['array' => $output]) ;

	}

	private function index()
	{
		return view('manage.index.0');
	}

	private function angels()
	{

	}



}
