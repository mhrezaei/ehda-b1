<?php

namespace App\Http\Controllers\manage;

use App\Models\State;
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

	public function index($request_tab='profile')
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
				$model = Auth::user() ;
				$model->changes = json_decode($model->unverified_changes) ;
				$states = State::get_combo() ;
				break;

			case 'card' :
				break ;

			case 'delete' :
				break;

			default:
				return view('errors.404');
		}

		//View...
		return view("manage.account.$request_tab" , compact('page' , 'model' , 'states'));
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

		return $this->jsonAjaxSaveFeedback( Auth::user()->oldPasswordChange($request->new_password) , [
			'success_redirect' => 'manage/index'
		] ) ;
	}

	public function saveProfile(Requests\Manage\AccountProfileRequest $request)
	{
		$model = Auth::user() ;
		$model->meta('edit_reject_notice' , null);

		// IF REVERT BACK...
		if($request->_submit == 'revert') {
			$model->unverified_changes = null;
			$model->unverified_flag = 0 ;
			$ok = $model->save() ;
			return $this->jsonAjaxSaveFeedback($ok , [
					'success_message' => trans('manage.account.profile_revert_note') ,
					'success_refresh' => 1 ,
			]);

		}

		// IF SAVE ...
		$raw_data = $request->toArray() ;
		$new_data = [] ;
		foreach($raw_data as $field => $value) {
			if(isset($model->$field) and $model->$field != $value) {
				$new_data[$field] = $value ;
			}
		}
		if(sizeof($new_data)) {
			$model->unverified_changes = json_encode($new_data);
			$model->unverified_flag = 1 ;
		}
		else {
			$model->unverified_changes = null;
			$model->unverified_flag = 0 ;
		}
		$ok = $model->save() ;

		return $this->jsonAjaxSaveFeedback($ok , [
			'success_message' => trans('manage.account.profile_save_note') ,
			'success_refresh' => 1 ,
		]);
	}
}
