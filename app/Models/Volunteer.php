<?php
namespace App\Models;

use App\Traits\PermitsTrait;
use App\Traits\TahaModelTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;


class Volunteer extends Model implements AuthenticatableContract, CanResetPasswordContract
{
	use Authenticatable, CanResetPassword;
	use SoftDeletes;
	use PermitsTrait;
	use TahaModelTrait ;

	protected $guarded = ['id' , 'deleted_at' , 'roles' , 'domains' , 'unverified_changes' , 'settings'] ;
//	protected $fillable = [ 'email' , 'password' , 'name' , 'family' , 'gender' , 'birthday'] ;

	public function volunteer_logins()
	{
		return $this->hasMany('App\Models\Volunteer_login') ;
	}

	public function isDeveloper()
	{
		/*
		| @TODO: A better definition of Developer (ex. by melli no.) would be a good idea.
		*/
		if($this->id==1)
			return true ;
		else
			return false ;
	}

	public function fullName($with_title = false)
	{
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

	public function isActive()
	{
		if($this->published_at and !$this->trashed())
			return true  ;
		else
			return false ;
	}

	public function title()
	{
		if($this->gender==1)
			$title = trans('people.mr');
		else
			$title = trans('people.mrs');
	}

	public function home_city()
	{
		return State::find($this->home_city);

	}
	/*
	|--------------------------------------------------------------------------
	| Static Methods
	|--------------------------------------------------------------------------
	| These methods will select models for the purpose of listings and showing items.
	*/
	public static function selector($criteria = 'active')
	{
		switch($criteria) {
			case 'active':
				return self::where('published_at','>','0') ;
			case 'pending':
				return self::where('published_at' , null)->where('exam_passed_at' , '>' , '0') ;
			case 'care' :
				return self::where('unverified_flag' , '1');
			case 'examining' :
				return self::where('published_at' , null)->where('exam_passed_at' , null);
			case 'bin' :
				return self::onlyTrashed();

		}

	}

}
