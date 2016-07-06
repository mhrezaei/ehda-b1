<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Domain extends Model
{
	protected $guarded = ['id'];
	use SoftDeletes;

	public static function store($request)
	{
		$data = $request->toArray();
		unset($data['_token']);
		unset($data['_modal_id']);

		if($request->id)
			$affected = Self::where('id', $request->id)->update($data);
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