<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ResetPasswordTokenRequest extends Request
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
            'national' => 'required',
            'token' => 'required|numeric',
        ];
    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
            'token'  =>  'ed',
        ]);
        return $purified;

    }
}
