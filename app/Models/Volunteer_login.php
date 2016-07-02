<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer_login extends Model
{
    //
	public function volunteer()
	{
		return $this->belongsTo('App\Volunteer'); 
	}
}
