<?php

namespace App\Models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
	use TahaModelTrait;
	use SoftDeletes ;

	protected $guarded = ['id'] ;

	public function posts()
	{
		return $this->hasMany('App\Models\Post');
	}

	public function branch()
	{
		return $this->belongsTo('App\Models\Branch');
	}
}

