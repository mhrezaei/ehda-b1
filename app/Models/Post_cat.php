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

	public static function getName($slug)
	{
		$record = self::where('slug' , $slug)->first() ;
		return $record->title ;
	}
}
