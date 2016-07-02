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

	public function auth() //@TODO: Remove this function at Production
	{
//		$roles = ['cards', 'cards_new_one', 'volunteers_browse', 'settings_generala'];
//		$user_roles = Crypt::encrypt(json_encode($roles));
//
//		return view('templates.say', ['array' => $user_roles]);
//
		return view('templates.say', ['array' => Auth::user()]);

	}

	private function index()
	{
		return view('manage.index.0');
	}

	private function angels()
	{

	}



}
