<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Setting extends Model
{

	public static function set($slug, $new_value, $is_resident = -1)
	{
		$model = self::firstOrNew(['slug' => $slug]);
		$model->value = $new_value ;
		if($is_resident >= 0)
			$model->is_resident = $is_resident ;

		$model->keep() ;
		$model->save() ;
	}

	public static function get($slug, $is_resident = 'auto')
	{

	}

	public function drop($slug)
	{

	}

	public function keep() //Keeps the model in session
	{
//		if(!$this->is_resident)



	}

	private function forget($slug, $value = '__auto')
	{

	}


}
