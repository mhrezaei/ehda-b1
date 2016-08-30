<?php

namespace App\Http\Controllers;

use App\Events\SendEmail;
use App\Events\SendSms;
use App\Events\VolunteerForgotPassword;
use App\Jobs\SendEmailJob;
use App\Models\User;
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
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
	use TahaControllerTrait;
	protected $redirectTo = '/manage' ;

	public function login(Requests\AuthLoginRequest $request)
	{
		//Username...
		$user = User::selectBySlug($request->username , 'code_melli') ;
		if(!$user or $user->volunteer_status==0)
			return redirect()->back()->withErrors(trans('manage.login.error_username'));

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

		//Check Status...
		if($user->volunteer_status<0)
			return redirect()->back()->withErrors(trans('manage.login.error_deleted'));
		elseif($user->volunteer_status<8)
			return redirect()->back()->withErrors(trans('manage.login.error_not_published'));

		//Actual Login...
		Auth::loginUsingId( $user->id );
		if($user['password_force_change'])
			return redirect('/manage/old_password');
		return redirect()->back();

		//@TODO: Event for login (save into `logins`)
	}

	public function reset_password()
	{
		if(Auth::check()) return redirect('/manage/index');
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
			'refresh' => 100
		]);
	}

	public function reset_password_token_process(Requests\ResetPasswordTokenRequest $request)
	{
		if(Auth::check()) return redirect('/manage/index');

		$volunteer = Volunteer::where('code_meli',Crypt::decrypt($request->national))->first();
		if(!$volunteer)
			return $this->jsonSaveFeedback(trans('manage.reset_password.error_username'));

		if(!$volunteer->published_at)
			return $this->jsonFeedback(trans('manage.login.error_not_published'));

		if (strlen($volunteer['reset_token']) > 10)
		{
			$token = json_decode($volunteer['reset_token'], true);
			$time = Carbon::parse($token['expire_token']['date'])->diffInSeconds(Carbon::now());
			if ($time > 300)
			{
				return $this->jsonFeedback(trans('manage.reset_password.reset_token_expire_time'));
				$volunteer->updateVolunteerForResetPassword(0);
			}

			if ($token['reset_token'] != $request->token)
				return $this->jsonFeedback(trans('manage.reset_password.reset_token_invalid'));

			$volunteer->updateVolunteerForResetPassword(1);
			Auth::loginUsingId( $volunteer->id );
			return $this->jsonFeedback(trans('manage.reset_password.token_success_request'),[
				'redirect' => '/manage/old_password',
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
//		Event::fire(new VolunteerForgotPassword(Volunteer::find(1)));
//		Event::fire(new SendSms('numbers', 'msg'));
//		Event::fire(new SendEmail('mr.mhrezaei@gmail.com', 'reciever name', 'subject', 'msg body html code'));
//		$this->dispatch(new SendEmailJob('mr.mhrezaei@gmail.com', 'reciever name', 'subject', 'msg body html code'));

		$b = "محمد هادی رضائی کمال آباد";
//		printf("length of string: %d \n", mb_strlen($b, 'UTF-8'));
//		for ($i=0; $i < mb_strlen($b, 'UTF-8'); $i++){
//			$ch = mb_substr($b, $i, 1, 'UTF-8');
//			$chlen = strlen($ch);
//			$hexs = '';
//			for ($j=0; $j < $chlen; $j++)
//				$hexs = $hexs . sprintf("%x", ord($ch[$j]));
//			printf ("width=%d => '%s' |hex=%s\n", $chlen, $ch, $hexs );
//		}
//		echo '<br>' . strlen($b) . '<br>' . mb_strlen($b, 'UTF-8');

//		$font = public_path('assets' . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'BNazanin.ttf');
//		$aa = imagettfbbox(25, 0, $font, $b);

		print_r(csrf_token());

	}
}
