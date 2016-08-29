<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostSaveRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $input = $this->all() ;
        $module = $input['branch'] ;

        if($input['id']) {
            if($input['is_published'])
                return Auth::user()->can("$module.edit");
            else
                return Auth::user()->can("$module.publish");
        }
        else {
            if($input['action']=='publish')
                return Auth::user()->can("$module.publish");
            else
                return Auth::user()->can("$module.create") ;
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = $this->all();
        $now = Carbon::now()->format('Y/m/d');
        return [
            'id' => 'numeric' ,
            'action' => 'required|in:draft,save,publish' ,
            'title' => 'required' ,
            'text' => 'required' ,
            'category_id' => 'required_if:action,publish',
            'publish_date' => 'date' ,
        ];
    }

    public function all()
    {
        $value	= parent::all();
        $purified = ValidationServiceProvider::purifier($value,[
            'id'  =>  'ed|numeric',
            'action'  =>  'lower',
            'branch' => 'decrypt' ,
        ]);
        return $purified;

    }
}
