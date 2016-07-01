<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //

	public function exam_questions()
	{
		return $this->hasMany('App\Models\Exam_question');
	}
}
