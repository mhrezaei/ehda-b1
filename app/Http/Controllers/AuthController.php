<?php

namespace App\Http\Controllers;

use App\Events\VolunteerLoggedIn;
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
			if(sha1(md5($request->password)) == $volunteer['password']) //@TODO: @Hadi: Check the encryption please :)
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

	private function _login(Requests\AuthLoginRequest $request)
	{
		//Fail Safety Loop...
		$loginTries = $request->session()->get('loginTried',0)+1;
		if($loginTries>3) {
			$request->session()->set('loginTried',0);
			$refresh = true ;
		}
		else {
			$request->session()->set('loginTried',$loginTries);
			$refresh = false ;
		}

		//Attempts...
		$logged = Auth::attempt([
				'email' => $request['username'] ,
				'password' => $request['password'],

		] , 0);

		if(!$logged) {
			return json_encode(['message'=>trans('authentications.login-invalid'),'refresh'=>$refresh]);
		}

		//Killing Safety Loop...
		$request->session()->forget('loginTried');
		return json_encode(['ok'=>$logged , 'message'=>trans('authentications.login-success') , 'refresh'=>1]);

	}
}
