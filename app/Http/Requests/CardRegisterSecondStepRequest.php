<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CardRegisterSecondStepRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = $this->all();
        return [
            'name_first' => 'required|persian:60',
            'name_last' => 'required|persian:60',
            'gender' => 'required|numeric|min:1|max:3',
            'name_father' => 'required|persian:60',
            'code_id' => 'required|numeric',
            'birth_date' => 'required',
            'birth_dateExtra' => 
        ];
    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
            'name_first'  =>  'pd',
            'name_last'  =>  'pd',
            'gender' => 'ed',
            'name_father' => 'pd',
            'code_id' => 'ed',
            'birth_date' => 'ed',
        ]);
        return $purified;

    }
}
