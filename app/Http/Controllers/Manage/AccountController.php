<?php

namespace App\Http\Controllers\manage;

use App\Models\State;
use App\Models\User;
use App\Traits\TahaControllerTrait;
use Carbon\Carbon;
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
				$model = Auth::user() ;
				break ;

			case 'delete' :
				$model = Auth::user() ;
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


		// Purification ...
		$raw_data = $request->toArray();

		$home = State::find($request->home_city) ;
		if($home) {
			$raw_data['home_province'] = $home->parent_id  ;
		}
		else {
			$raw_data['home_province'] = 0 ;
		}

		$work = State::find($request->work_city) ;
		if($work) {
			$raw_data['work_province'] = $work->parent_id  ;
		}
		else {
			$raw_data['work_province'] = 0 ;
		}

		// IF SAVE ...
		if($model->volunteer_status>=8) { //confirmed active profile
			$new_data = [];
			foreach($raw_data as $field => $value) {
				//if(isset($model->$field) and $model->$field != $value) {
				if($field[0] != '_' and $model->$field != $value) {
					$new_data[ $field ] = $value;
				}
			}
			if(sizeof($new_data)) {
				$model->unverified_changes = json_encode($new_data);
				$model->unverified_flag    = 1;
			}
			else {
				$model->unverified_changes = null;
				$model->unverified_flag    = 0;
			}
			$ok = $model->save();
			return $this->jsonAjaxSaveFeedback($ok , [
				'success_message' => trans('manage.account.profile_save_note') ,
				'success_refresh' => 1 ,
			]);
		}
		else { //pending profile (should be directly saved. no need to admin approval)
			$data = $raw_data ;
			$data['id']  = $model->id ;
			$complete_profile = true ;

			foreach(User::$volunteers_mandatory_fields as $field) {
				if(!in_array($field , ['code_melli']) and !$data[$field]) {
					$complete_profile = false ;
					return $this->jsonFeedback($field);
				}
			}

			if($complete_profile) {
				$data['volunteer_status'] = 3 ;
			}

			$ok = User::store($data) ;


			return $this->jsonAjaxSaveFeedback( $ok , [
				'success_message' => trans('forms.feed.done') ,
				'success_refresh' => 0 ,
			]);
		}

	}

	public function card(Request $request)
	{
		//Preparations...
		$data = $request->toArray() ;
		$user = Auth::user() ;


		//Processing donatable organs...
		$user->organs = null ;
		foreach(User::$donatable_organs as $donatable_organ) {
			if($data['_'.$donatable_organ])
				$user->organs .= ' '.trans("people.organs.$donatable_organ").' ' ;
		}
		if(!trim($user->organs))
			return $this->jsonFeedback(trans('validation.javascript_validation.organs'));

		//Saving...
		if(!$user->isCard()) {
			$user->card_registered_at = Carbon::now()->toDateTimeString() ;
			$user->card_status = 8 ;
			$user->card_no = User::generateCardNo() ;
		}
		$user->newsletter = $request->newsletter ;
		$saved = $user->save() ;

		//Returning...
		return $this->jsonSaveFeedback($saved , [
				'success_refresh' => true ,
		]);

	}

	public function card_delete()
	{
		return $this->jsonSaveFeedback( Auth::user()->cardDelete() , [
			'success_refresh' => 1 ,
		]);
	}

	public function volunteer_delete(Request $request)
	{
		$user = Auth::user() ;
		Auth::logout();
		$request->session()->flush() ;

		return $this->jsonSaveFeedback( $user->volunteerDelete() , [
				'success_refresh' => 1 ,
		]);

	}
}
