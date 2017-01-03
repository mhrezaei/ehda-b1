<?php

namespace App\Http\Controllers;

use App\Events\SendEmail;
use App\Events\SendSms;
use App\Events\UserForgotPassword;
use App\Jobs\SendEmailJob;
use App\Models\Setting;
use App\Models\State;
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
use Morilog\Jalali\Facades\jDate;

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

		if (! $user->exam_passed_at)
			return redirect('/volunteers/exam');

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

	public function relogin_panel()
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
		$relogin = true;
		return view('manage.login.0', compact('captcha', 'relogin'));
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
	public function logout(Request $request)
	{
		$logged_developer = $request->session()->pull('logged_developer') ;


		if($logged_developer)
			$logged_developer = decrypt($logged_developer);

		if($logged_developer) {
			$ok = Auth::loginUsingId( $logged_developer );
			return redirect('/manage') ;
		}

		Auth::logout();
		Session::flush();
		return redirect('/login');
	}

	private function sms()
	{
		$users = User::where('home_province', '7')->get();
		echo '<table style="direction: rtl; font-family: Tahoma;">';
		echo '<thead>';
		echo '<tr>';
		echo '<th>ردیف</th>';
		echo '<th>نام و نام خانوادگی</th>';
		echo '<th>نام پدر</th>';
		echo '<th>کدملی</th>';
		echo '<th>تاریخ تولد</th>';
		echo '<th>شماره موبایل</th>';
		echo '<th>شماره ثابت</th>';
		echo '<th>استان</th>';
		echo '<th>شهر</th>';
		echo '<th>شماره عضویت</th>';
		echo '<th>تاریخ عضویت</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		$a = 1;
		foreach ($users as $user)
		{
			echo '<tr>';
			echo '<td>' . $a . '</td>';
			echo '<td>' . $user->name_first . ' ' . $user->name_last . '</td>';
			echo '<td>' . $user->name_father . '</td>';
			echo '<td>' . $user->code_melli . '</td>';
			echo '<td>' . jDate::forge($user->birth_date)->format('Y/m/d') . '</td>';
			echo '<td>' . $user->tel_mobile . '</td>';
			echo '<td>' . $user->home_tel . '</td>';
			echo '<td>' . State::find($user->home_province)->title . '</td>';
			echo '<td>' . State::find($user->home_city)->title . '</td>';
			echo '<td>' . $user->card_no . '</td>';
			echo '<td>' . jDate::forge($user->register_at)->format('Y/m/d') . '</td>';
			echo '</tr>';
			$a++;
		}
		echo '</tbody>';
		echo '</table>';
	}
}
