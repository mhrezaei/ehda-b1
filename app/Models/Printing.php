<?php

namespace App\Models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Printing extends Model
{
	use SoftDeletes, TahaModelTrait;

	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	|
	*/

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function event()
	{
		return $this->belongsTo('App\Models\Post');
	}

}
