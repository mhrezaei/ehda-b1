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

	public static function selector($post_id, $key)
	{
		$model = Self::where('post_id', $post_id)->where('key', $key)->first();
		if($model)
			return $model->value;
		else
			return false;
	}

}
