<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submit extends Model
{
    //
	public function submit_cat()
	{
		return $this->belongsTo('App\Submit_cat');
	}
}
