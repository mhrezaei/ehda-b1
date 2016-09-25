<?php

namespace App\Http\Controllers;

use App\Events\SendEmail;
use App\Events\SendSms;
use App\Events\UserForgotPassword;
use App\Jobs\SendEmailJob;
use App\Models\User;
use App\Providers\SecKeyServiceProvider;
use App\Providers\SmsServiceProvider;
use App\Temp\Mhr_user;
use App\Traits\TahaControllerTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
	use TahaControllerTrait;
	protected $redirectTo = '/manage' ;

	/**
	 * @param Requests\AuthLoginRequest $request
	 * @return mixed
     */
	public function login(Requests\AuthLoginRequest $request)
	{
		//Username...
		$user = User::selectBySlug($request->username , 'code_melli') ;
		if(!$user)
		{
			return redirect()->back()->withErrors(trans('manage.login.error_username'));
		}

		if (! $user->isActive('volunteer') and ! $user->isActive('card') and !$user->isDeveloper())
		{
			return redirect()->back()->withErrors(trans('manage.login.error_not_published'));
		}

		//Password...
		$true_pass = false ;
		if($user['password_force_change']==2) {
			//old verification:
			if(md5(sha1($request->password)) == $user['password'])
				$true_pass = true ;
		}
		else {
			//laravel verification:
			$true_pass = Hash::check($request->password, $user['password']);
		}
		if(!$true_pass)
			return redirect()->back()->withErrors(trans('manage.login.error_password'));

		//Actual Login...
		Auth::loginUsingId( $user->id );
		if($user['password_force_change'])
			return redirect('/password/old_password');

		if ($user->isVolunteer())
		{
			return redirect('/manage/index');
		}
		else
		{
			return redirect('/');
		}

		//@TODO: Event for login (save into `logins`)
	}

	/**
	 * @return mixed
     */
	public function reset_password()
	{
		if(Auth::check())
		{
			if(Auth::user()->isActive('volunteer'))
			{
				return redirect('/manage/index');
			}
			else
			{
				return redirect('/members/my_card');
			}
		}
		$captcha = SecKeyServiceProvider::getQuestion('fa');
		return view('manage.reset_password.0', compact('captcha'));
	}

	/**
	 * @param Requests\ResetPasswordRequest $request
	 * @return mixed
     */
	public function reset_password_process(Requests\ResetPasswordRequest $request)
	{
		if(Auth::check())
		{
			if(Auth::user()->isActive('volunteer'))
			{
				return redirect('/manage/index');
			}
			else
			{
				return redirect('/members/my_card');
			}
		}

		//Username...
		$user = User::selectBySlug($request->username , 'code_melli') ;
		if(!$user)
		{
			return $this->jsonFeedback(trans('manage.login.error_username'), [
				'ok' => 0,
			]);
		}
		if (! $user->isActive('volunteer') and ! $user->isActive('card'))
		{
			return $this->jsonFeedback(trans('manage.login.error_not_published'), [
				'ok' => 0,
			]);
		}

		$user->makeForgotPasswordToken();
		Event::fire(new UserForgotPassword($user));
		$national = Crypt::encrypt($request->username);
		return $this->jsonFeedback(trans('manage.reset_password.reset_token_success_send'), [
			'ok' => 1,
			'callback' => "reset_password_process('$national')",
			'refresh' => 100
		]);
	}

	/**
	 * @param Requests\ResetPasswordTokenRequest $request
	 * @return mixed
     */
	public function reset_password_token_process(Requests\ResetPasswordTokenRequest $request)
	{
		if(Auth::check())
		{
			if(Auth::user()->isActive('volunteer'))
			{
				return redirect('/manage/index');
			}
			else
			{
				return redirect('/members/my_card');
			}
		}
		$user = User::selectBySlug($request->national , 'code_melli') ;
		if(!$user)
		{
			return $this->jsonFeedback(trans('manage.login.error_username'), [
				'ok' => 0,
			]);
		}
		if (! $user->isActive('volunteer') and ! $user->isActive('card'))
		{
			return $this->jsonFeedback(trans('manage.login.error_not_published'), [
				'ok' => 0,
			]);
		}

		if (strlen($user['reset_token']) > 10)
		{
			$token = json_decode($user['reset_token'], true);
			$time = Carbon::parse($token['expire_token']['date'])->diffInSeconds(Carbon::now());
			if ($time > 300)
			{
				return $this->jsonFeedback(trans('manage.reset_password.reset_token_expire_time'));
				$user->updateUserForResetPassword(0);
			}

			if ($token['reset_token'] != $request->token)
				return $this->jsonFeedback(trans('manage.reset_password.reset_token_invalid'));

			$user->updateUserForResetPassword(1);
			Auth::loginUsingId( $user->id );
			return $this->jsonFeedback(trans('manage.reset_password.token_success_request'),[
				'redirect' => '/password/old_password',
				'ok' => 1,
			]);
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
		if(Auth::check())
		{
			if(Auth::user()->isActive('volunteer'))
			{
				return redirect('/manage/index');
			}
			else
			{
				return redirect('/members/my_card');
			}
		}
		$captcha	= SecKeyServiceProvider::getQuestion('fa');
		return view('manage.login.0', compact('captcha'));
	}

	/**
	 * @return mixed
     */
	public function old_password()
	{
		if(!Auth::check()) return redirect()->back();
		$user = Auth::user();
		if (! $user['password_force_change']) return redirect('/manage/index');
		return view('manage.old_password.0');
	}

	/**
	 * @param Requests\OldPasswordRequest $request
	 * @return mixed
     */
	public function old_password_process(Requests\OldPasswordRequest $request)
	{
		if(!Auth::check()) return redirect()->back();
		$user = Auth::user();
		if ($user['password_force_change'] == 1)
		{
			if (Hash::check($request->password, $user['password']))
				return redirect()->back()->withErrors(trans('manage.old_password.error_new_password_equal_old_password'));
		}

		if ($user->oldPasswordChange($request->password))
		{
			if(Auth::user()->isActive('volunteer'))
			{
				return redirect('/manage/index');
			}
			else
			{
				return redirect('/members/my_card');
			}
		}
		else
		{
			return redirect()->back()->withErrors(trans('validation.invalid'));
		}
	}

	/**
	 * @return mixed
     */
	public function logout()
	{
		Auth::logout();
		Session::flush();
		return redirect('/login');
	}

	public function sms()
	{
		// Zoon C
//		$sit[] = 'C-2-1-12';
//		$sit[] = 'C-3-1-12';
//		$sit[] = 'C-4-1-13';
//		$sit[] = 'C-5-1-13';
//		$sit[] = 'C-6-1-13';
//		$sit[] = 'C-7-1-14';
//		$sit[] = 'C-8-1-14';
//		$sit[] = 'C-9-1-14';
//		$sit[] = 'C-10-1-15';
//		$sit[] = 'C-11-1-15';
//		$sit[] = 'C-12-1-15';

		// Zoon B
//		$sit[] = 'B-2-13-30';
//		$sit[] = 'B-3-13-30';
//		$sit[] = 'B-4-14-32';
//		$sit[] = 'B-5-14-34';
//		$sit[] = 'B-6-14-34';
//		$sit[] = 'B-7-15-36';
//		$sit[] = 'B-8-15-36';
//		$sit[] = 'B-9-15-37';
//		$sit[] = 'B-10-16-37';
//		$sit[] = 'B-11-16-38';
//		$sit[] = 'B-12-16-38';

		// Zoon D
//		$sit[] = 'D-2-31-41';
//		$sit[] = 'D-3-31-43';
//		$sit[] = 'D-4-33-45';
//		$sit[] = 'D-5-35-46';
//		$sit[] = 'D-6-35-48';
//		$sit[] = 'D-7-37-50';
//		$sit[] = 'D-8-37-51';
//		$sit[] = 'D-9-38-52';
//		$sit[] = 'D-10-38-52';
//		$sit[] = 'D-11-39-53';
//		$sit[] = 'D-12-39-53';

		//Zoon G
//		$sit[] = 'G-13-1-15';
//		$sit[] = 'G-14-1-15';
//		$sit[] = 'G-15-1-15';
//		$sit[] = 'G-16-1-15';
//		$sit[] = 'G-17-1-15';
//		$sit[] = 'G-18-1-15';
//		$sit[] = 'G-19-1-14';
//		$sit[] = 'G-20-1-13';
//		$sit[] = 'G-21-1-12';
//		$sit[] = 'G-22-1-10';
//		$sit[] = 'G-23-1-10';
//		$sit[] = 'G-24-1-7';

		//Zoon F
//		$sit[] = 'F-13-16-38';
//		$sit[] = 'F-14-16-38';
//		$sit[] = 'F-15-16-37';
//		$sit[] = 'F-16-16-37';
//		$sit[] = 'F-17-16-36';
//		$sit[] = 'F-18-16-35';
//		$sit[] = 'F-19-15-33';
//		$sit[] = 'F-20-14-31';
//		$sit[] = 'F-21-13-29';
//		$sit[] = 'F-22-11-26';
//		$sit[] = 'F-23-11-24';
//		$sit[] = 'F-24-8-19';
//		$sit[] = 'F-25-1-16';

		//Zoon E
//		$sit[] = 'E-13-39-53';
//		$sit[] = 'E-14-39-53';
//		$sit[] = 'E-15-38-52';
//		$sit[] = 'E-16-38-52';
//		$sit[] = 'E-17-37-51';
//		$sit[] = 'E-18-36-50';
//		$sit[] = 'E-19-34-47';
//		$sit[] = 'E-20-32-44';
//		$sit[] = 'E-21-30-41';
//		$sit[] = 'E-22-27-37';
//		$sit[] = 'E-23-25-34';
//		$sit[] = 'E-24-20-26';

		//Zoon A Balcony
//		$sit[] = 'A-1-1-25';
//		$sit[] = 'A-2-1-22';
//		$sit[] = 'A-3-1-21';
//		$sit[] = 'A-4-1-19';
//		$sit[] = 'A-5-1-17';
//		$sit[] = 'A-6-1-15';
//		$sit[] = 'A-7-1-14';

		//Zoon E Balcony
//		$sit[] = 'E-1-1-25';
//		$sit[] = 'E-2-1-22';
//		$sit[] = 'E-3-1-21';
//		$sit[] = 'E-4-1-19';
//		$sit[] = 'E-5-1-17';
//		$sit[] = 'E-6-1-15';
//		$sit[] = 'E-7-1-14';

		//Zoon D Balcony
//		$sit[] = 'D-1-1-14';
//		$sit[] = 'D-2-1-16';
//		$sit[] = 'D-3-1-16';
//		$sit[] = 'D-4-1-18';
//		$sit[] = 'D-5-1-19';
//		$sit[] = 'D-6-1-20';
//		$sit[] = 'D-7-1-21';

		// Zoon C Balcony
//		$sit[] = 'C-1-15-33';
//		$sit[] = 'C-2-17-36';
//		$sit[] = 'C-3-17-37';
//		$sit[] = 'C-4-19-41';
//		$sit[] = 'C-5-20-44';
//		$sit[] = 'C-6-21-47';
//		$sit[] = 'C-7-22-50';

		// Zoon B Balcony
//		$sit[] = 'B-1-34-47';
//		$sit[] = 'B-2-37-51';
//		$sit[] = 'B-3-38-54';
//		$sit[] = 'B-4-42-59';
//		$sit[] = 'B-5-45-63';
//		$sit[] = 'B-6-48-67';
//		$sit[] = 'B-7-51-72';
//
//		for ($i = 0; $i < count($sit); $i++)
//		{
//			$sit[$i] = explode('-', $sit[$i]);
//			for ($a = 0, $n = $sit[$i][2]; $a <= ($sit[$i][3] - $sit[$i][2]); $a++)
//			{
//				// echo zoon
////				echo $sit[$i][0] . '<br>';
//
//				// echo row
////				echo $sit[$i][1] . '<br>';
//
//				// echo col
//				echo $n++ . '<br>';
//			}
//		}

//		echo '<pre>';
//		print_r($sit);
//		echo '</pre>';

	}
}
