<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submit_cat extends Model
{
    //
	public function submits()
	{
		return $this->hasMany('App\Submit');
	}
}
