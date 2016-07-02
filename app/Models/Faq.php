<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
	public function faq_cat()
	{
		return $this->belongsTo('App\Models\Faq_cat');
	}
}
