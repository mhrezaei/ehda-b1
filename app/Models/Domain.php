<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TahaModelTrait ;


class Domain extends Model
{
	protected $guarded = ['id'];
	use SoftDeletes;
	use TahaModelTrait ;


	public function states()
	{
		return $this->hasMany('App\Models\State') ;
	}
}