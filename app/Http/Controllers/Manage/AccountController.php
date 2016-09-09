<?php

namespace App\Http\Controllers\manage;

use App\Traits\TahaControllerTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
	use TahaControllerTrait ;
	private $page = array() ;

	public function __construct()
	{
		$this->page[0] = ['account' , trans('manage.account.account_settings')] ;
	}

	public function index($request_tab='change_password')
	{
		//Preparations...
		$page = $this->page ;
		$page[1] = [$request_tab , trans("manage.account.$request_tab")];

		switch($request_tab) {
			case 'settings' :
				break;

			case 'change_password' :
				break;

			case 'profile' :
				break;

			case 'card' :
				break ;

			case 'delete' :
				break;

			default:
				return view('errors.404');
		}

		//View...
		return view("manage.account.$request_tab" , compact('page'));
	}

	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/
	public function savePassword(Requests\Manage\AccountChangePasswordRequest $request)
	{
		$redirect = null ;

		if (!Hash::check($request->current_password, Auth::user()->password)) {
			$attempts = $request->session()->get('password_attempts',0);
			$request->session()->put('password_attempts' , $attempts+1);
			if($attempts>3) {
				Auth::logout();
				$redirect = 'logout' ;
			}

			return $this->jsonFeedback( trans('people.event.current_password_incorrect') , ['redirect' => $redirect] );
		}

		return $this->jsonAjaxSaveFeedback( Auth::user()->oldPasswordChange($request->password) , [
			'success_redirect' => 'manage/index'
		] ) ;
	}
}
