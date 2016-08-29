<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;


class BranchesSaveRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('developer');
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
             'plural_title' => 'required|unique:branches,plural_title,'.$id,
             'singular_title' => 'required',
             'slug' => 'required|unique:branches,slug,'.$id,
        ];

    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
	        'slug'  =>  'lower',
	        'have_rss' => 'bool' ,
	        'have_comments' => 'bool' ,
	        'is_gallery' => 'bool' ,
	        'is_hidden' => 'bool' ,
        ]);
        return $purified;

    }

}
