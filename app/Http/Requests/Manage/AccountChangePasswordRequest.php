<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\models\Branch;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;


class AccountChangePasswordRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
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
             'current_password' => 'required|different:new_password',
             'new_password' => 'required|min:8|same:password2',
        ];

    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
        ]);
        return $purified;

    }

}
