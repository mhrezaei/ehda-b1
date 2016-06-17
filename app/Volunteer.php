<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    //
	public function volunteer_logins()
	{
		return $this->hasMany('App\Volunteer_login') ;
	}
}
