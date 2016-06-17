<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam_question extends Model
{

	public function exam()
	{
		return $this->belongsTo('App\Exam');
	}
}
