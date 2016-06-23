<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;

class AuthLoginRequest extends Request
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
             'username' => 'required|number', //no need to check existence here.
             'password' => 'required',
//             'security' => 'required|captcha:'.$input['key'], @TODO: Remove Comment
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
