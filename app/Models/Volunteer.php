<?php
namespace App\Models;

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
		if(!$this) return false ;
		$return = $this->name_first . " " . $this->name_last ;
		if($with_title)
			$return = $this->title() . " " . $return ;

		return $return ;
	}

	public function delete()
	{
		$this->deleted_at = Carbon::now()->toDateTimeString();
		$this->deleted_by = Auth::user()->id ;
		return $this->save();
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

	public function say($property)
	{
		switch($property) {
			case 'created_at' :
			case 'updated_at' :
			case 'published_at' :
			case 'deleted_at' :
				return AppServiceProvider::pd(jDate::forge($this->$property)->format('j M Y _ H:m'));

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
				return AppServiceProvider::pd($this->code_meli);

			case 'birth_date' :
				return AppServiceProvider::pd(jDate::forge($this->$property)->format('j M Y'));

			case 'birth_city' :
			case 'edu_city' :
				return State::find($this->$property)->fullName();

			case 'marital_status' :
				switch($this->$property) {
					case 1 :
						return 'married';
					case 2 :
						return 'single' ;
				}

			default:
				return $this->$property ;
		}
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
