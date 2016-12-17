<?php

namespace App\models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
	//
	use TahaModelTrait;

	public static function get($model_name , $record_id, $key)
	{
		$model = Self::where('model_name', $model_name)->where('record_id', $record_id)->where('key', $key)->first();

		if($model)
			return $model->value;
		else
			return null ;
	}

	public static function set($model_name , $record_id , $key , $value)
	{
		//safety...
		if(!$model_name or !$record_id)
			return false ;

		//If no value: delete
		if(!$value)
			return self::where('model_name' , $model_name)->where('record_id' , $record_id)->where('key' , $key)->delete() ;

		//automatic insert or update
		$meta = self::where('model_name' , $model_name)->where('record_id' , $record_id)->where('key' , $key)->first() ;
		if($meta) {
			$meta->value = $value ;
			return $meta->save() ;
		}
		else {
			$meta = new self ;
			$meta->model_name = $model_name ;
			$meta->record_id = $record_id ;
			$meta->key = $key ;
			$meta->value = $value ;
			return $meta->save() ;
		}
	}


}
