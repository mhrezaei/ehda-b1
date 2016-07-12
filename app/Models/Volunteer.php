<?php
namespace App\Models;

use App\Traits\PermitsTrait;
use Carbon\Carbon;
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

//	protected $fillable = [ 'email' , 'password' , 'name' , 'family' , 'gender' , 'birthday'] ;

	protected $guarded = ['id'];

	public function volunteer_logins()
	{
		return $this->hasMany('App\Models\Volunteer_login') ;
	}

	public function isDeveloper()
	{
		/*
		| @TODO: A better definition of Developer (ex. by melli no.) would be a good idea.
		*/
//		return false ;

		if($this->id==1)
			return true ;
		else
			return false ;
	}

	public function makeForgotPasswordToken()
	{
		$token['reset_token'] = rand(100000, 999999);
		$token['expire_token'] = Carbon::now()->addMinutes(5);
		$this->update([
			'reset_token' => json_encode($token),
		]);
		return $token['reset_token'];
	}

	public function oldPasswordChange($password)
	{
		return $this->update([
			'password'=> $password,
			'password_force_change' => 0
		]);
	}



}
