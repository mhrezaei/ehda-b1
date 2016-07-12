<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;


class PostCatsSaveRequest extends Request
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
//        $id = $input['id'] ;
        return [
             'title' => 'required',
             'slug' => 'required',
        ];

        //@TODO: Find a way to control unique title and slugs here (considering `parent_id`)
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
