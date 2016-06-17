<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //

	public function exam_questions()
	{
		return $this->hasMany('App\Exam_question');
	}
}
