<?php
namespace App\Traits;


trait TahaModelTrait
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


	public static function store($request)
	{
		if(is_array($request))
			$data = $request ;
		else
			$data = $request->toArray();

		if(isset($data['_token']))
			unset($data['_token']);
		if(isset($data['_modal_id']))
			unset($data['_modal_id']);

		if($data['id'])
			$affected = Self::where('id', $data['id'])->update($data);
		else {
			$model = Self::create($data);
			if($model)
				$affected = 1;
			else
				$affected = 0;
		}

		return $affected;

	}
}