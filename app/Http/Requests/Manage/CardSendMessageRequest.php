<?php

namespace App\Http\Requests\Manage;

use App\Http\Requests\Request;
use App\Providers\ValidationServiceProvider;
use Illuminate\Support\Facades\Auth;


class CardSendMessageRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$input = $this->all() ;
		if(isset($input['ids']) and !Auth::user()->can('cards.bulk'))
			return false ;

		return Auth::user()->can('cards.send');
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
//		$input = $this->all();
		return [
			'message'=> 'required',
			'title' => 'required' ,
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
