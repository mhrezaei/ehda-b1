<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;

class CardRegisterFirstStepRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
             'name_first' => 'required|persian',
             'name_last' => 'required|persian',
             'code_melli' => 'required|code_melli',
             'security' => 'required|captcha:'.$input['key'],
        ];
    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
            'security'  =>  'ed',
            'username'  =>  'ed',
        ]);
        return $purified;

    }
}
