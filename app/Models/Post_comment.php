<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Model;

class Post_comment extends Model
{
	//

	public function post()
	{
		$this->belongsTo('App\Models\Post') ;
	}
}
