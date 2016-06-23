<?php

namespace App\Http\Controllers;

use App\Providers\SecKeyServiceProvider;
use App\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

use App\Http\Requests;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	//
	protected $redirectTo = '/manage' ;

	public function login(Requests\AuthLoginRequest $request)
	{
		//Username...
		$volunteer = Volunteer::where('code_meli',$request->username)->withTrashed()->first();
		if(!$volunteer)
			return redirect()->back()->withErrors(trans('manage.login.error_username'));

		//Password...
		$true_pass = false ;
		if($volunteer['password_force_change']==2) {
			//old verification:
			if(md5(sha1($request->password)) == $volunteer['password'])
				$true_pass = true ;
		}
		else {
			//laravel verification:
			$true_pass = Hash::check($request->password, $volunteer['password']);
		}
		if(!$true_pass)
			return redirect()->back()->withErrors(trans('manage.login.error_password'));

		//Check published_at and deleted_at...
		if($volunteer->trashed())
			return redirect()->back()->withErrors(trans('manage.login.error_deleted'));
		if(!$volunteer->published_at)
			return redirect()->back()->withErrors(trans('manage.login.error_not_published'));

		//Actual Login...
		Auth::loginUsingId( $volunteer->id );
		return redirect()->back();

		//@TODO: Event for login (save into `volunteers_logins`)
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function login_panel()
	{
		if(Auth::check()) return redirect('/manage/index');
		$captcha	= SecKeyServiceProvider::getQuestion('fa');
		return view('manage.login.0', compact('captcha'));
	}

	public function logout()
	{
		Auth::logout();
		return redirect('/manage/index');
	}
}
