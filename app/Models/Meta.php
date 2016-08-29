<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
	//

	public function post()
	{
		$this->belongsTo('App\Models\Post');
	}


	public static function get($post_id, $key)
	{
		$model = Self::where('post_id', $post_id)->where('key', $key)->first();
		if($model)
			return $model->value;
		else
			return null ;
	}

	public static function set($post_id , $key , $value)
	{
		//safety...
		if(!$post_id)
			return false ;

		//If no value: delete
		if(!$value)
			return self::where('post_id' , $post_id)->where('key' , $key)->delete() ;

		//automatic insert or update
		$meta = self::where('post_id' , $post_id)->where('key' , $key)->first() ;
		if($meta) {
			$meta->value = $value ;
			return $meta->save() ;
		}
		else {
			$meta = new self ;
			$meta->post_id = $post_id ;
			$meta->key = $key ;
			$meta->value = $value ;
			return $meta->save() ;
		}
	}

	public static function allowedMeta($string)
	{
		$result = [] ;
		$array = explode(' ',$string) ;
		foreach($array as $item) {
			$thing = explode(':' , $item) ;
			$key = $thing[0] ;
			$type = isset($thing[1])? $thing[1] : 'text' ;
			$result[$key] = $type ;
		}

		return $result ;
	}

	public static function allowedMetaByBranch($branch_slug)
	{
		$branch = Branch::selectBySlug($branch_slug) ;
		if($branch)
			return self::allowedMeta($branch->allowed_meta) ;
		else
			return [] ;
	}

}
