<?php

namespace App\Models;

//use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Providers\AppServiceProvider;
use App\Traits\PermitsTrait;
use App\Traits\TahaModelTrait;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\jDate;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
	use Authenticatable, CanResetPassword;
	use PermitsTrait;
	use TahaModelTrait ;

	protected $guarded = ['id' , 'deleted_at' , 'roles' , 'domains' , 'unverified_changes' , 'unverified_flag' , 'settings'] ;

	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	|
	*/
	public function logins()
	{
		return $this->hasMany('App\Models\Login') ;
	}

	public function activities()
	{
		return $this->hasMany('App\Models\Activity') ;
	}

	public function setting($key)
	{
		//TODO: Fill it up.
	}
	/*
	|--------------------------------------------------------------------------
	| Stators
	|--------------------------------------------------------------------------
	|
	*/

	public function trashed($type='volunteer')
	{
		switch($type) {
			case 'volunteer' :
				if($this->volunteer_status < 0)
					return true ;
				else
					return false ;

			case 'card':
				if($this->card_status < 0)
					return true ;
				else
					return false ;

			default :
				return false ;

		}
	}


	/**
	 * @param string $key
	 * @return mixed
     */
	public function volunteerStatus($key = 'text')
	{

		//Discover...
		if($this->volunteer_status < 0) {
			$return['text'] = trans('people.volunteers.status.blocked') ;
			$return['color'] = 'danger';
		}
		elseif($this->volunteer_status == 1) {
			$return['text'] = trans('people.volunteers.status.examining') ;
			$return['color'] = 'info' ;
		}
		elseif($this->volunteer_status == 2) {
			$return['text'] = trans('people.volunteers.status.documentation') ;
			$return['color'] = 'info' ;
		}
		elseif($this->volunteer_status == 3) {
			$return['text'] = trans('people.volunteers.status.pending') ;
			$return['color'] = 'warning' ;
		}
		elseif($this->volunteer_status>=8) {
			if($this->unverified_flag) {
				$return['text'] = trans('people.volunteers.status.care') ;
				$return['color'] = 'warning' ;
			} else {
				$return['text'] = trans('people.volunteers.status.active') ;
				$return['color'] = 'success' ;
			}
		}

		//Return...
		if($key=='array')
			return $return ;
		else
			return $return[$key] ;
	}


	/**
	 * @return bool
     */
	public function isDeveloper()
	{
		if($this->id==1)
			return true ;
		else
			return false ;
	}

	/**
	 * @return bool
     */
	public function isVolunteer()
	{
		if($this->volunteer_status != 0)
			return true ;
		else
			return false ;
	}

	/**
	 * @return bool
     */
	public function isCard()
	{
		if($this->card_status != 0)
			return true ;
		else
			return false ;
	}

	/**
	 * @param string $type
	 * @return bool
     */
	public function isActive($type='volunteer')
	{
		$field = $type."_status" ;
		if($this->$field >= 8)
			return true ;
		else
			return false ;
	}

	public function title()
	{
		if($this->gender==1)
			$title = trans('people.mr');
		else
			$title = trans('people.mrs');

		if($this->edu_level >= 6)
			$title .= ' '.trans('people.dr');

		return $title ;
	}

	public function fullName($with_title = false)
	{
		if(!$this) return false ;
		$return = $this->name_first . " " . $this->name_last ;
		if($with_title)
			$return = $this->title() . " " . $return ;

		return $return ;
	}


	public function occupation()
	{
		$return = null ;

		if($this->job)
			$return .= $this->job. " / " ;

		$return .= trans('people.edu_level.'.$this->edu_level) ;

		if($this->edu_field)
			$return .= " / ".$this->edu_field ;

		return $return ;
	}


	public function say($property, $default='-')
	{
		switch($property) {
			case 'created_at' :
			case 'updated_at' :
			case 'published_at' :
			case 'deleted_at' :
			case 'exam_passed_at' :
			case 'card_registered_at' :
			case 'volunteer_registered_at' :
				if($this->$property) {
					return AppServiceProvider::pd(jDate::forge($this->$property)->format('j F Y [H:m]'));
				}
				else
					return $default ;

			case 'created_by' :
			case 'updated_by' :
			case 'published_by' :
			case 'deleted_by' :
				$model = self::find($this->$property);
				if($model)
					return $model->fullName() ;
				else
					return trans('forms.general.deleted');

			case 'code_meli' :
				return $this->say('code_melli' , $default) ;

			case 'code_melli' :
			case 'card_no' :
			case 'code_id' :
			case 'tel_mobile' :
			case 'tel_emergency' :
			case 'home_address' :
			case 'home_tel' :
			case 'home_postal_code' :
			case 'work_address' :
			case 'work_tel' :
			case 'work_postal_code' :
			case 'edu_field' :
			case 'job' :
			case 'exam_result' :
			case 'motivation' :
			case 'alloc_time' :
				return AppServiceProvider::pd($this->$property);

			case 'organs' :
				return $this->organs; //TODO: Do something here.

			case 'name' :
				return $this->name_first . " " . $this->name_last ;

			case 'fullName' :
				return $this->title().' '. $this->name_first . " " . $this->name_last ;

			case 'birth_date' :
				return AppServiceProvider::pd(jDate::forge($this->$property)->format('j F Y'));

			case 'gender' :
			case 'marital':
			case 'edu_level' :
			case 'familization' :
				return trans("people.$property.".$this->$property) ;

			case 'education' :
				return trans("people.education.".$this->edu_level);

			case 'birth_city' :
			case 'edu_city' :
			case 'home_city' :
			case 'work_city' :
			case 'home_province' :
			case 'work_province' :
				$state = State::find($this->$property);
				if($state)
					return $state->fullName();
				else
					return $default;

			case 'from_domain' :
				$domain = Domain::selectBySlug($this->$property) ;
				if($domain)
					return $domain->title;
				else
					return $default;

			default:
				return $this->$property ;
		}

	}

	/*
	|--------------------------------------------------------------------------
	| Password Activities
	|--------------------------------------------------------------------------
	|
	*/
	/**
	 * @return mixed
     */
	public function makeForgotPasswordToken()
	{
		$token['reset_token'] = rand(100000, 999999);
		$token['expire_token'] = Carbon::now()->addMinutes(5);

		$this->reset_token = json_encode($token);
		$this->save();

		return $token['reset_token'];
	}

	/**
	 * @param $password
	 * @return bool
     */
	public function oldPasswordChange($password)
	{
		$this->password = $password;
		$this->password_force_change = 0;
		return $this->save();
	}

	/**
	 * @param int $password_force_change
	 * @return bool
     */
	public function updateUserForResetPassword($password_force_change = 1)
	{
		$this->reset_token = null;
		$this->password_force_change = $password_force_change;
		return $this->save();
	}

	/*
	|--------------------------------------------------------------------------
	| Selectors
	|--------------------------------------------------------------------------
	|
	*/

	public function counter($type, $criteria)
	{
		return self::selector($type,$criteria)->count();
	}
	public static function selector($type, $criteria)
	{
		if($type=='volunteer') {
			switch($criteria) {
				case 'examining':
					return self::where('volunteer_status' , '=' , '1') ;
				case 'documentation' :
					return self::where('volunteer_status' , '=' , '2') ;
				case 'pending' :
					return self::where('volunteer_status' , '=' , '3') ;
				case 'active':
					return self::where('volunteer_status' , '>=' , '8') ;
				case 'care' :
					return self::where('volunteer_status' , '>' , '0')->where('unverified_flag' , '1');
				case 'bin' :
					return self::where('volunteer_status' , '<' , '0');

			}
		}

	}

	/*
	|--------------------------------------------------------------------------
	| Actions
	|--------------------------------------------------------------------------
	|
	*/

	public static function generateCardNo()
	{
		$record = self::orderBy('card_no', 'desc')->first() ;
		if(!$record)
			return 1500 ;
		else
			return $record->card_no + 1 ;
	}

	public function cardDelete()
	{
		if($this->isVolunteer()) {
			$this->card_status = 0 ;
			$this->card_registered_at = null ;
			$this->card_no = null ;
			$this->organs = null ;
			return $this->save() ;
		}
		else {
			return parent::delete() ;
		}
	}

	public function volunteerDelete()
	{
		$this->volunteer_status = -$this->volunteer_status ;
		if(Auth::check()) {
			$this->deleted_at = Carbon::now()->toDateTimeString() ;
			$this->deleted_by = Auth::user()->id ;
		}
		return $this->save() ;
	}

	public function volunteerUndelete()
	{
		$this->volunteer_status = -$this->volunteer_status ;
		$this->deleted_at = null ;
		$this->deleted_by = null ;
		return $this->save() ;

	}

	public function volunteerHardDelete()
	{
		if($this->card_status) {
			$this->volunteer_status = 0 ;
			$this->volunteer_registered_at = null ;
			$this->roles = null ;
			$this->domains = null ;
			return $this->save() ;
		}
		else {
			return parent::delete() ;
		}
	}

}

