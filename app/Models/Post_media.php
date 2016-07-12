<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post_media extends Model
{
    //
	public function post()
	{
		$this->belongsTo('App\Post') ;
	}
}
