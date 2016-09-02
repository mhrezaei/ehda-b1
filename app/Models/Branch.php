<?php

namespace App\models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
	use TahaModelTrait ;
	use SoftDeletes ;

	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	| 
	*/
	

	public function posts($criteria='all')
	{
		return Post::selector($this->slug , $criteria);
	}

	public function categories()
	{
		return $this->hasMany('App\Models\Category');
	}

	/*
	|--------------------------------------------------------------------------
	| Stators
	|--------------------------------------------------------------------------
	|
	*/

	public function allowedMeta()
	{
		$string = str_replace(' ' , null , $this->allowed_meta) ;
		$result = [] ;

		$array = explode(',',$string) ;
		foreach($array as $item) {
			$thing = explode(':' , $item) ;
			$key = $thing[0] ;
			$type = isset($thing[1])? $thing[1] : 'text' ;
			if(!$key) continue ;
			$result[$key] = $type ;
		}

		return $result ;
	}

	public static function getTitle($slug , $is_singular=false)
	{
		$model = self::selectBySlug($slug);
		if(!$model)
			return false ;
		else
			return $model->title($is_singular);

	}

	public function title($is_singular=false)
	{
		if($is_singular)
			return $this->singular_title ;
		else
			return $this->plural_title ;
	}
}
