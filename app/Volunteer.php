<?php
namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;


class Volunteer extends Model implements AuthenticatableContract, CanResetPasswordContract
{
	use Authenticatable, CanResetPassword;
	use SoftDeletes;

//	protected $fillable = [ 'email' , 'password' , 'name' , 'family' , 'gender' , 'birthday'] ;

	public function volunteer_logins()
	{
		return $this->hasMany('App\Volunteer_login') ;
	}

	public function isDeveloper()
	{
		/*
		| @TODO: A better definition of Developer (ex. by melli no.) would be a good idea.
		*/
	}

	/*
	|--------------------------------------------------------------------------
	| Role Managements
	|--------------------------------------------------------------------------
	|
	*/


	public function getRoles()
	{
		return json_decode(Crypt::decrypt($this->roles),true);
	}

	public function setRoles($roles_array)
	{
		$this->roles = Crypt::encrypt(json_encode($roles_array));
		$this->save();
	}

	public function attachRole($role , $permission=null)
	{
		$roles_array = $this->getRoles();

		if(!isset($roles_array[$role]))
			$roles_array[$role] = [] ;
		if($permission) {
			if(!in_array($permission,$roles_array[$role]))
				array_push($roles_array[$role],$permission);
		}

		$this->setRoles($roles_array);
	}

	public function detachRole($role, $permission=null)
	{
		$roles_array = $this->getRoles();

		if($permission)
			if(($key = array_search($permission, $roles_array[$role])) !== false) {
				unset($roles_array[$role][$key]);
			}
		else
			unset($roles_array[$role]) ;

		$this->setRoles($roles_array);

	}

	public function setDomains($domains)
	{

	}

	public function getDomains($domains)
	{

	}


	public function attachDomain($domain)
	{

	}

	public function detachDomain($domain)
	{

	}

	public function can($role, $permission = 'any' , $domain='any')
	{

	}

}
