<?php
namespace App\Traits;


trait TahaTrait
{
	/**
	 * @param        $stack is a Model::where() return
	 * @param string $mood could be either 'get' , 'count' or just nothing for the intact return
	 * @return mixed
	 */
	private static function stacker($stack , $mood = 'get')
	{
		switch($mood) {
			case '' :
			case 'self':
				return $stack ;
			case 'count' :
				return $stack->count() ;
			case 'array' :
				return $stack->get()->toArray() ;
			case 'get':
			default:
				return $stack->get() ;
		}

	}
}