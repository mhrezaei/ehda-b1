<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post_cat extends Model
{
	protected $guarded = ['id'];

	public function posts()
	{
		return $this->hasMany('App\Models\Post');
	}

	public static function getName($slug)
	{
		$record = self::where('slug' , $slug)->first() ;
		return $record->title ;
	}

	public static function inUnique($request, $field_name)
	{
		$found_models = Self::where([
				[$field_name,$request->$field_name] ,
				['parent_id' , $request->parent_id],
				['id' , '!=' , $request->id ],
		])->count();

		return !$found_models ;
	}

	public static function store($request)
	{
		$data = $request->toArray() ;
		unset($data['_token']);
		
		if($request->id)
			$affected = Self::where('id',$request->id)->update($data);
		else {
			$model = Self::create($data);
			if($model) $affected = 1; else $affected = 0;
		}

		return $affected ;
	}
}
