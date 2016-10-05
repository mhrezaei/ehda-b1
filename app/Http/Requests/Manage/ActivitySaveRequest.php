<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Models\Activity;
use App\Models\Setting;
use App\Providers\ValidationServiceProvider;


class ActivitySaveRequest extends Request
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
        if($input['_submit'] == 'save')  {
            return [
                 'slug' => 'required|alpha_dash|not_in:'.Activity::$reserved_slugs.'|unique:activities,slug,'.$input['id'],
                 'title' => 'required|unique:activities,title,'.$input['id'] ,
            ];
        }
        else {
            return [] ;
        }

    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
            'slug' => 'lower' ,
        ]);
        return $purified;

    }

}
