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

        if(in_array($input['action'] , ['publish','schedule']))
            return Auth::user()->can("$module.publish") ;
        elseif($input['id']==0)
            return Auth::user()->can("$module.create") ;
        else
            return Auth::user()->can("$module.edit") ;
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
            'action' => 'required|in:preview,draft,save,publish,schedule' ,
            'title' => 'required' ,
            'text' => 'required' ,
            'category_id' => 'required_if:action,publish',
            'publish_date' => 'date|after:'.$now ,
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
