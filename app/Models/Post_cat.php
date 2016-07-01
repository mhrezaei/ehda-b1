<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post_cat extends Model
{
	//
	public function posts()
	{
		return $this->hasMany('App\Models\Post');
	}
}
