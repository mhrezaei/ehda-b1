<?php
namespace App\Traits;


trait TahaModelTrait
{

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