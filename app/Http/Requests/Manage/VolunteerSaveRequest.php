<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;


class VolunteerSaveRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true ; //permission checked in the controller
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$input = $this->all();
		$id = $input['id'] ;
		return [
			'name_first' => "required|min:2",
			'name_last' => "required|min:2",
			'name_father' => 'required|min:2' ,
			'code_melli' => "required|code_melli|unique:users,code_melli,".$id,
			'code_id' => "required" ,
			'email'=> 'required|email|unique:users,email,'.$id,
			'password'=> 'required_if:id,0|min:8',
			'gender'=>'required',
			'birth_city' => 'required',
			'marital' => 'required' ,
			'birth_date' => 'required|date' ,
			'tel_mobile' => 'required|phone:mobile',
			'tel_emergency' => 'required|different:tel_mobile|phone:mobile',
			'home_tel' => 'phone:fixed',
			'work_tel' => 'phone:fixed',
		];

	}

	public function all()
	{
		$value	= parent::all();
		$purified = ValidationServiceProvider::purifier($value,[
			'code_melli'  =>  'ed',
			'code_id' => 'ed' ,
			'gender' => 'number',
			'birth_city' => 'number',
			'tel_mobile' => 'ed' ,
			'tel_emergency'=> 'ed' ,
			'edu_level' => 'number',
			'edu_city' => 'number',
			'home_city' => 'number',
			'home_tel' => 'ed' ,
			'work_city' => 'number',
			'introduction' => 'number' ,
			'home_address' => 'pd' ,
			'work_address' => 'pd' ,
			'work_tel' => 'ed' ,
			'motivation' => 'pd' ,
			'alloc_time' => 'pd' ,
		]);
		return $purified;

	}

}
