<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;

class OldPasswordRequest extends Request
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
        //$input = $this->all();
        return [
            'password' => 'required|min:8|max:50|', //no need to check existence here.
            'password2' => 'required|same:password',
        ];
    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
            'password'  =>  'ed',
            'password2'  =>  'ed',
        ]);
        return $purified;

    }
}
