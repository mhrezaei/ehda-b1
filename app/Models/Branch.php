<?php

namespace App\models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Branch extends Model
{
	use TahaModelTrait ;
	use SoftDeletes ;
	protected $guarded = ['id'];
	public static $available_features = ['image' , 'text' , 'abstract' , 'rss' , 'comment' , 'gallery' , 'category'] ;
	public static $available_templates = ['album' , 'post' , 'slideshow' , 'developers'] ;
	public static $available_meta_types = ['text' , 'textarea' , 'date'];


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

	public function encrypted_slug()
	{
		return Crypt::encrypt($this->slug) ;
	}

	public function hasFeature($feature)
	{
		return str_contains($this->features , $feature) ;
	}

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

	public function encrypted()
	{
		return Crypt::encrypt($this->slug);
	}
}
