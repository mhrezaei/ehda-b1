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
		$input = $this->all() ;
		if($input['id']==0)
			return Auth::user()->can('volunteers.create') ;
		else
			return Auth::user()->can('volunteers.edit');
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
			'name_first' => "required",
			'name_last' => "required",
			'code_meli' => "required|code_melli|unique:volunteers,code_meli,".$id,
			'email'=> 'required|email|unique:volunteers,email,'.$id,
			'password'=> 'required_if:id,0|min:10',
			'gender'=>'required',
			'birth_city' => 'required',
			'marital_status' => 'required' ,
			'birth_date' => 'required|date' ,
			'tel_mobile' => 'required|phone:mobile',
			'tel_emergency' => 'required|different:tel_mobile|phone:mobile',
			'home_tel' => 'phone:fixed',
			'work_tel' => 'phone:fixed',
		];

		//@TODO: more validation may be required here, such as phone number patterns
	}

	public function all()
	{
		$value	= parent::all();
		$purified = ValidationServiceProvider::purifier($value,[
			'code_meli'  =>  'ed',
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
