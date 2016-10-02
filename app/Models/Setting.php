<?php

namespace App\Models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class Setting extends Model
{
	public static $available_data_types = ['text' , 'textarea' , 'boolean' , 'date' , 'photo'] ;
	public static $available_categories = ['socials' , 'contact' , 'template'] ;
	public static $default_when_not_found = '-' ;
	public static $unset_signals = ['unset'] ;
	public static $reserved_slugs = 'none,setting' ;
	protected $guarded = ['id' , 'global_value' , 'domain_value'] ;

	use TahaModelTrait ;

	public static function get($slug, $domain = 'global')
	{
		$model = self::where('slug' , $slug) ;

		//If not found...
		if(!$model)
			return self::$default_when_not_found ;

		//If not from domains...
		if(!$model->available_for_domains or $domain=='global')
			return $model->global_value ;

		//If from domains...
		$value = json_decode($model->domain_value , true) ;
		if(isset($value[$domain]))
			return $value[$domain] ;
		else
			return $model->global_value ;
	}

	public static function set($slug, $new_value , $domain = 'global')
	{
		$model = self::where('slug' , $slug) ;

		//If not found...
		if(!$model)
			return false ;

		//If global domain...
		if($domain=='global') {
			$model->global_value = $new_value;
			return $model->update();
		}

		//If not available for domains...
		if(!$model->available_for_domains and $domain!='global')
			return false ;

		//If for domains...
		$value = json_decode($model->domain_value , true) ;

		if(in_array($new_value , self::$unset_signals))
			unset($value[$domain]) ;
		else
			$value[$domain] = $new_value ;

		$model->domain_value = json_encode($value) ;
		return $model->update() ;

	}

	/*
	|--------------------------------------------------------------------------
	| Helper Functions
	|--------------------------------------------------------------------------
	|
	*/
	public function categories()
	{
		$return = [] ;
		foreach(self::$available_categories as $category)  {
			$trans = "manage.devSettings.downstream.category.$category" ;
			if(Lang::has($trans))
				$caption = trans($trans);
			else
				$caption = $category ;
			array_push($return , [$category , $caption]) ;
		}

		return $return ;
	}

	public function dataTypes()
	{
		$return = [] ;
		foreach(self::$available_data_types as $data_type)  {
			$trans = "manage.devSettings.downstream.data_type.$data_type" ;
			if(Lang::has($trans))
				$caption = trans($trans);
			else
				$caption = $data_type ;
			array_push($return , [$data_type , $caption]) ;
		}

		return $return ;

	}
}
