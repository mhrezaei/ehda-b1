<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq_cat extends Model
{
	public function faqs()
	{
		return $this->hasMany('App\Models\Faq');
	}
}
