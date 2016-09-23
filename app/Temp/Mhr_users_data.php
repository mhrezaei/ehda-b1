<?php

namespace App\Temp;

use Illuminate\Database\Eloquent\Model;

class Mhr_users_data extends Model
{
	public function mhr_user()
	{
		return $this->belongsTo('App\Temp\Mhr_users_data');
	}
}
