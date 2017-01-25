<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;


class CardSaveRequest extends Request
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
			return Auth::user()->can('cards.create') ;
		else
			return Auth::user()->can('cards.edit');
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
		return [] ;
		return [
			'name_first' => "required|min:2",
			'name_last' => "required|min:2",
			'name_father' => 'required|min:2' ,
			'code_melli' => "required|code_melli|unique:users,code_melli,".$id,
			'code_id' => "required" ,
			'email'=> 'email|',
			'gender'=>'required',
			'birth_city' => 'required',
			'edu_level' => 'required|numeric' ,
			'home_city' => 'required' ,
			'birth_date' => 'required|date' ,
			'tel_mobile' => 'required|phone:mobile',
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
//			'birth_city' => 'number',
			'tel_mobile' => 'ed' ,
			'tel_emergency'=> 'ed' ,
//			'edu_level' => 'number',
			'edu_city' => 'number',
//			'home_city' => 'number',
			'home_tel' => 'ed' ,
			'home_address' => 'pd' ,
			'_heart' => 'bool',
		]);
		return $purified;

	}

}
