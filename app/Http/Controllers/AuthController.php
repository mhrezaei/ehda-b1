<?php

namespace App\Http\Controllers;

use App\Events\VolunteerForgotPassword;
use App\Providers\SecKeyServiceProvider;
use App\Models\Volunteer;
use App\Providers\SmsServiceProvider;
use App\Traits\TahaControllerTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
	use TahaControllerTrait;
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
		$captcha = SecKeyServiceProvider::getQuestion('fa');
		return view('manage.reset_password.0', compact('captcha'));
	}

	public function reset_password_process(Requests\ResetPasswordRequest $request)
	{
		if(Auth::check()) return redirect('/manage/index');

		//Username...
		$volunteer = Volunteer::where('code_meli',$request->username)->first();
		if(!$volunteer)
			return $this->jsonFeedback(trans('manage.reset_password.error_username'));

		if(!$volunteer->published_at)
			return $this->jsonFeedback(trans('manage.login.error_not_published'));

		$volunteer->makeForgotPasswordToken();
		Event::fire(new VolunteerForgotPassword($volunteer));
		$national = Crypt::encrypt($request->username);
		return $this->jsonFeedback(trans('manage.reset_password.reset_token_success_send'), [
			'ok' => 1,
			'callback' => "reset_password_process('$national')",
		]);
	}

	public function reset_password_token_process(Requests\ResetPasswordTokenRequest $request)
	{
		if(Auth::check()) return redirect('/manage/index');

		$volunteer = Volunteer::where('code_meli',Crypt::decrypt($request->national))->first();
		if(!$volunteer)
			return $this->jsonFeedback(trans('manage.reset_password.error_username'));

		if(!$volunteer->published_at)
			return $this->jsonFeedback(trans('manage.login.error_not_published'));

		if (strlen($volunteer['reset_token']) > 10)
		{
			$token = json_decode($volunteer['reset_token'], true);
			$time = Carbon::parse($token->expire_token->date)->diffInSeconds(Carbon::now());
			if ($time > 300)
				return $this->jsonFeedback(trans('manage.reset_password.reset_token_expire_time'));

			if ($token->reset_token != $request->token)
				return $this->jsonFeedback(trans('manage.reset_password.reset_token_invalid'));

			$volunteer->updateVolunteerForResetPassword();
			Auth::loginUsingId( $volunteer->id );
			return redirect('/manage/old_password');
		}
		else
		{
			return $this->jsonFeedback(trans('manage.reset_password.invalid_request'),[
				'refresh' => 1,
			]);
		}
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

		if ($volunteer->oldPasswordChange(Hash::make($request->password)))
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

	public function sms()
	{
		//return view('templates.widget.email');
//		$date = Carbon::now()->addMinutes(5);
//		$date = $date->diffInMinutes($date->copy()->addMinutes(10));
//		return view('templates.say' , ['array'=> $date]);
		Event::fire(new VolunteerForgotPassword(Volunteer::find(1)));
	}
}
