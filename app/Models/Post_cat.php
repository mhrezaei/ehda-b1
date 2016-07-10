<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TahaModelTrait ;

class Post_cat extends Model
{
	use TahaModelTrait ;
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

	public static function isUnique($request, $field_name)
	{
		$found_models = Self::where([
				[$field_name,$request->$field_name] ,
				['parent_id' , $request->parent_id],
				['id' , '!=' , $request->id ],
		])->count();

		return !$found_models ;
	}

}
