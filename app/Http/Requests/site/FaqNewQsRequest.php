<?php

namespace App\Http\Requests\site;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;

class FaqNewQsRequest extends Request
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
             'full_name' => 'required|persian:60',
             'title' => 'persian:60',
             'text' => 'min:10',
             'tel_mobile' => 'phone:mobile',
             'email' => 'required|email',
        ];
    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
            'text'  =>  'pd',
            'tel_mobile'  =>  'ed',
            'email'  =>  'ed',
            'title'  =>  'pd',
            'full_name'  =>  'pd',
        ]);
        return $purified;

    }
}
