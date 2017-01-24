<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\models\Branch;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;


class SmsSendRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('cards.send') ;
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
             'numbers' => 'required',
             'text' => 'required|max:400',
        ];

    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
            'numbers' => "ed",
        ]);
        return $purified;

    }

}
