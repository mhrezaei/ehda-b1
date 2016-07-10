<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;


class CitiesSaveRequest extends Request
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
             'title' => 'required',
             'province_id' => 'required|numeric|exists:states,id,parent_id,0',
             'domain_id' => 'required|numeric|exists:domains,id',
        ];

    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
	        'province_id'  =>  'number',
	        'domain_id' => 'number' ,
        ]);
        return $purified;

    }

}
