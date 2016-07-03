<?php

namespace App\Http\Controllers\Manage;

use Carbon\Carbon;
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
//		$this->middleware('auth');

	}

	public function show($module , $sub='*')
	{
		//Error 404...
		if(!method_exists($this,$module)) return view('errors.404');

		//Error 403...
		if(substr($sub,0,1)=='!')
			$permit_request = "$module.*" ;
		else
			$permit_request = "$module.$sub" ;

		if(!Auth::user()->can($permit_request))
			return view('errors.403');

		//Showing...
		return $this->$module($sub) ;
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
		$output = Carbon::now() ;

		//out...
		return view('templates.say')->with(['array' => $output]) ;

		echo Carbon::now();

	}

	private function index()
	{
		return view('manage.index.0');
	}

	private function settings($request_tab)
	{
		if(!$request_tab or $request_tab=='*') $request_tab = 'posts-cats' ;
		$request_module = 'settings' ;

		return view("manage.settings.0",compact('request_module','request_tab'));
	}

	private function devSettings($request_tab)
	{
		//Preparetions...
		if(!$request_tab or $request_tab=='*') $request_tab = 'posts-cats' ;
		$request_module = 'devSettings' ;

		//Model...
		switch($request_tab) {
			case 'posts-cats' :
				break;
		}

		//View...
		return view("manage.settings.dev",compact('request_module','request_tab'));

	}



}
