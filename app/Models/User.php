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
use Morilog\Jalali\jDate;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
	use Authenticatable, CanResetPassword;
	use SoftDeletes;
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


	public function isDeveloper()
	{
		if($this->id==1)
			return true ;
		else
			return false ;
	}

	public function isVolunteer()
	{
		if($this->volunteer_status != 0)
			return true ;
		else
			return false ;
	}

	public function isCard()
	{
		if($this->card_status != 0)
			return true ;
		else
			return false ;
	}

	public function isActive()
	{
		if(in_array($this->volunteer_status , [8,9]) or in_array($this->card_status , [8,9]))
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

		$return .= trans('forms.edu.'.$this->edu_level) ;

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
				return trans("forms.education.".$this->edu_level);

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
	public function makeForgotPasswordToken()
	{
		$token['reset_token'] = rand(100000, 999999);
		$token['expire_token'] = Carbon::now()->addMinutes(5);

		$this->reset_token = json_encode($token);
		$this->save();

		return $token['reset_token'];
	}

	public function oldPasswordChange($password)
	{
		$this->password = $password;
		$this->password_force_change = 0;
		return $this->save();
	}

	public function updateVolunteerForResetPassword($password_force_change = 1)
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
	public function selector($type, $criteria)
	{
		
	}

}

