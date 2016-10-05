<?php

namespace App\Models;

use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;


class Activity extends Model
{
	use TahaModelTrait;

	public static $reserved_slugs = 'admin,root' ;
	protected $guarded = ['id'] ;

}
