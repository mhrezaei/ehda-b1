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
	        'code_meli' => "required|size:10|unique:volunteers,code_meli,".$id,
	        'email'=> 'required|email|unique:volunteers,email,'.$id,
	        'password'=> 'required_if:id,0|min:10',
	        'gender'=>'required',
	        'birth_city' => 'required',
            'birth_date' => 'required|date' ,
	        'tel_mobile' => 'required',
	        'tel_emergency' => 'required',
        ];
    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
	        'code_meli'  =>  'ed',
	        'gender' => 'number',
	        'birth_city' => 'number',
	        'edu_level' => 'number',
	        'edu_city' => 'number',
	        'home_city' => 'number',
	        'work_city' => 'number',
	        'introduction' => 'number' ,
	        'home_address' => 'pd' ,
	        'work_address' => 'pd' ,
	        'motivation' => 'pd' ,
	        'alloc_time' => 'pd' ,
        ]);
	    return $purified;

    }

}
