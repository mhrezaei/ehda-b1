<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq_cat extends Model
{
	public function faqs()
	{
		return $this->hasMany('App\Faq');
	}
}
