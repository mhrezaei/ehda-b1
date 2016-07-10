<?php

namespace App\Http\Controllers\Manage;

use App\Models\Domain;
use App\Models\Post_cat;
use App\Models\State;
use App\Providers\ValidationServiceProvider;
use App\Traits\TahaControllerTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class DevSettingsController extends Controller
{
	use TahaControllerTrait ;
	private $page = array();

	public function __construct()
	{
		$this->middleware('can:dev');

		$this->page[0] = ['devSettings'];
	}

	public function index($request_tab = 'posts-cats')
	{
		//Preparetions...
		$page = $this->page;
		$page[1] = [$request_tab];
		$sub_method = str_replace('-', '', 'index_' . $request_tab);
		if(!method_exists($this, $sub_method))
			return view('errors.404');

		//Model...
		$model_data = $this->$sub_method();

		//View...
		return view("manage.settings.dev", compact('page', 'model_data'));

	}
	private function index_postscats($parent_id = 0)
	{
		$model = Post_cat::where('parent_id', $parent_id)->orderBy('title')->get();

		return $model;

		//TODO: browse, edition and deletion of sub-cats
	}

	private function index_domains()
	{
		$model = Domain::orderBy('title')->get();
		return $model ;

		//@TODO: edition/deletion of cities and volunteers
	}

	private function index_states()
	{
		$model = State::get_provinces();
		return $model ;
	}

	public function add($request_tab)
	{
		//Preparetion...
		$page = $this->page;
		$page[1] = [$request_tab];
		$page[2] = ['add'];
		$view = "manage.settings." . $request_tab . "_add";

		//View...
		if(!View::exists($view))
			return view('errors.404');

		return view($view, compact('page'));
	}

	public function editor($request_tab , $item_id)
	{
		//Appears in modal and doesn't need $this->page stuff

		switch($request_tab) {
			case 'states' :
				if($item_id>0) {
					$model = State::find($item_id) ;
					if(!$model) return trans('validation.invalid') ;
					return view('manage.settings.states-modalEditor' , compact('model')) ;
				}
				else {
					$cities = State::get_cities();
					return view('manage.settings.states-modalEditor' , compact('cities'));
				}

			default:
				return view('errors.404');
		}

	}

	public function item($request_tab, $item_id)
	{
		//Preparetion...
		$page = $this->page;
		$page[1] = [$request_tab];
		$page[2] = ['edit',null,''];
		$view = "manage.settings." . $request_tab . "_edit";

		$sub_method = str_replace('-', '', 'item_' . $request_tab);
		if(!method_exists($this, $sub_method))
			return view('errors.404');

		//Model...
		$model_data = $this->$sub_method($item_id);

		//View...
		if(!View::exists($view))
			return view('errors.404');

		return view($view, compact('page', 'model_data'));


	}

	public function item_domains($q)
	{
		$json = '[
    {"id":"856","name":"House"},
    {"id":"1035","name":"Desperate Housewives"},
    ...
]';

		echo $json;
	}


	private function item_postscats($item_id)
	{
		$model = Post_cat::findOrFail($item_id);
		if(!$model) {
			echo view('errors.404');
			die();
		}

		return $model;

	}

	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	public function save_postsCats(Requests\Manage\PostCatsSaveRequest $request)
	{
		if(!Post_cat::isUnique($request,'title'))
			return json_encode([
					'message' => trans('manage.devSettings.posts-cats.add.err_title_unique') ,
			]);
		if(!Post_cat::isUnique($request,'slug'))
			return json_encode([
					'message' => trans('manage.devSettings.posts-cats.add.err_slug_unique') ,
			]);

		//Save...
		return $this->jsonSaveFeedback(Post_cat::store($request) , [
				'success_redirect' => '/manage/devSettings/posts-cats' ,
		]);
	}


	public function save_domains(Requests\Manage\DomainSaveRequest $request)
	{
		return $this->jsonAjaxSaveFeedback(Domain::store($request) ,[
				'success_refresh' => 1,
		]);
	}

	public function save_states(Requests\Manage\StatesSaveRequest $request)
	{
		return $this->jsonAjaxSaveFeedback(State::store($request) ,[
			'success_refresh' => 1,
		]);

	}

}
