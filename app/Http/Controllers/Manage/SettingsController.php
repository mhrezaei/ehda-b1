<?php

namespace App\Http\Controllers\Manage;

use App\models\Branch;
use App\Models\Domain;
use App\Models\Post_cat;
use App\Models\Setting;
use App\Models\State;
use App\Traits\TahaControllerTrait;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hamcrest\Core\Set;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class SettingsController extends Controller
{
	use TahaControllerTrait ;
	private $page = array();

	public function __construct()
	{
		$this->page[0] = ['devSettings' , trans('manage.modules.devSettings')];
	}

	public function index($request_tab = 'socials')
	{
		//Preparetions...
		$page[0] = ['settings' , trans('manage.modules.settings')];
		$page[1] = [$request_tab , trans("manage.devSettings.downstream.category.$request_tab")];

		//Model...
		$model_data = Setting::where('category' , $request_tab)->where('developers_only' , '0') ;
		if(!Auth::user()->isGlobal())
			$model_data = $model_data->where('available_for_domains' , '=' , '1') ;
		$model_data = $model_data->orderBy('title')->get();

		if(!$model_data->count())
			return view('errors.404');

		$request_domain = Auth::user()->getDomain() ;

		//View...
		return view("manage.settings.settings", compact('page', 'model_data' , 'request_tab' , 'request_domain'));

	}



	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	public function save(Requests\Manage\SettingSaveRequest $request)
	{
		$data = $request->toArray() ;
		$domain = Auth::user()->getDomain() ;

		if(!$domain)
			return $this->jsonFeedback( trans('validation.http.error403') );

		foreach($data as $item => $value ) {
			if($item[0] == '_')
				continue ;

			$ok = Setting::set($item , $value , $domain) ;
		}

		return $this->jsonSaveFeedback($ok , [
			'success_refresh' => true  ,
		]);


	}


}
