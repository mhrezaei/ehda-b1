<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	public function post_cat()
	{
		return $this->belongsTo('App\Post_cat');
	}

	public function post_comments()
	{
		return $this->hasMany('App\Post_comment');
	}

	public function post_medias()
	{
		return $this->hasMany('App\Post_media');
	}
}
