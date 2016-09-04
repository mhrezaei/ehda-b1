<?php
/*
|--------------------------------------------------------------------------
| A Trait to define all the methods required to access the central meta system
|--------------------------------------------------------------------------
| Depends on TahaModelTrait to use the className() method.
*/

namespace App\Traits;
use App\models\Meta;

trait TahaMetaTrait
{


	public function metas()
	{
		return $this->hasMany('App\Models\Meta') ;
	}


	/**
	 * Automatic read an write to meta. Provide a value to perform write. Do not enter value to perform read.
	 * @param        $key
	 * @param string $value
	 * @return bool|null
	 */
	public function meta($key , $value='READ')
	{
		if($value==='READ')
			return Meta::get($this->className() , $this->id , $key) ;
		else
			return Meta::set($this->className() , $this->id , $key , $value) ;
	}

}