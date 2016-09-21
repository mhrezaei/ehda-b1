<?php

namespace App\Temp;

use Illuminate\Database\Eloquent\Model;

class Mhr_user extends Model
{
    public function mhr_users_data()
    {
        return $this->hasOne('App\Temp\Mhr_user');
	}
}
