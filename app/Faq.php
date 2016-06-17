<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
	public function faq_cat()
	{
		return $this->belongsTo('App\Faq_cat');
	}
}
