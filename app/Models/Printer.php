<?php

namespace App\Models;

use App\Providers\AppServiceProvider;
use App\Traits\TahaMetaTrait;
use App\Traits\TahaModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\jDate;


class Printer extends Model
{
	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	| 
	*/

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
}