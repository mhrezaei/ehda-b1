<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam_question extends Model
{

	public function exam()
	{
		return $this->belongsTo('App\Models\Exam');
	}
}
