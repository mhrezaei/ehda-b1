<?php

namespace App\models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
	use TahaModelTrait ;
	use SoftDeletes ;

	public function posts($criteria='all')
	{
		return Post::selector($this->slug , $criteria);
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
