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

	public function show($module , $sub='*')
	{
		if(!method_exists($this,$module)) return view('errors.404');

		if(!Auth::user()->can("$module.$sub"))
			return view('errors.403');

		return $this->$module() ;
	}

	public function auth() //@TODO: Remove this method and its route at Production
	{
		//in...
		$user = Auth::user() ;
		$output = $user ;

		//here...
//		$user->attachPermits('posts-celebs.*') ;
		$user->detachPermits('cards.edit') ;

		$output = $user->getPermits() ;

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

	private function cards()
	{
		echo 1 ;
	}



}
