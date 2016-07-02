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
		if($volunteer['password_force_change'])
			return redirect('/manage/old_password');
		return redirect()->back();

		//@TODO: Event for login (save into `volunteers_logins`)
	}

	public function reset_password()
	{
		return view('manage.reset_password.0');
	}

	public function reset_password_process()
	{
		if(Auth::check()) return redirect('/manage/index');
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

	public function old_password()
	{
		if(!Auth::check()) return redirect()->back();
		$volunteer = Auth::user();
		if (! $volunteer['password_force_change']) return redirect('/manage/index');
		return view('manage.old_password.0');
	}

	public function old_password_process(Requests\OldPasswordRequest $request)
	{
		if(!Auth::check()) return redirect()->back();
		$volunteer = Auth::user();
		if ($volunteer['password_force_change'] == 1)
		{
			if (Hash::check($request->password, $volunteer['password']))
				return redirect()->back()->withErrors(trans('manage.old_password.error_new_password_equal_old_password'));
		}

		$affected = Volunteer::where('id', $volunteer['id'])
			->update([
				'password'=> Hash::make($request->password),
				'password_force_change' => 0
			]);
		if ($affected)
		{
			return redirect('/manage/index');
		}
		else
		{
			return redirect()->back()->withErrors(trans('validation.invalid'));
		}
	}

	public function logout()
	{
		Auth::logout();
		return redirect('/manage/index');
	}
}
