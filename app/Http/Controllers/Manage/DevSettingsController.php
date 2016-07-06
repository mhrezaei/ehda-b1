<?php

namespace App\Http\Controllers\Manage;

use App\Models\Domain;
use App\Models\Post_cat;
use App\Providers\ValidationServiceProvider;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class DevSettingsController extends Controller
{
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
	| Save Functions
	|--------------------------------------------------------------------------
	| Route passes everything to 'save' and the request is splitted overthere.
	*/


	public function save($request_tab, Request $request)
	{
		$sub_method = str_replace('-', '', 'save_' . $request_tab);

		if(!method_exists($this, $sub_method))
			return json_encode([
					'message' => trans('validation.invalid'),
			]);
		else
			return $this->$sub_method($request) ;
	}

	private function save_domains(Request $request)
	{
		//Validation...
		$id = $request->id ;
		$this->validate($request, [
			'title' => "required|unique:domains,title,$id",
			'slug' => "required|unique:domains,slug,$id",
		]);

		//Save...
		$is_saved = Domain::store($request);

		//Return...
		if($is_saved) {
			return json_encode([
					'ok' => '1',
					'message' => trans('forms.feed.done'),
					'refresh' => '1',
					'callback' => '',
			]);
		}
		else {
			return json_encode([
					'message' => trans('validation.invalid'),
			]);
		}

	}
	private function save_postsCats(Request $request)
	{
		//Validation...
		$this->validate($request, [
			'title' => 'required',
			'slug' => 'required',
		]);

		if(!Post_cat::inUnique($request,'title'))
			return json_encode([
					'message' => trans('manage.devSettings.posts-cats.add.err_title_unique') ,
			]);
		if(!Post_cat::inUnique($request,'slug'))
			return json_encode([
					'message' => trans('manage.devSettings.posts-cats.add.err_slug_unique') ,
			]);

		//Save...
		$is_saved = Post_cat::store($request);

		//Return...
		if($is_saved) {
			return json_encode([
				'ok' => '1',
				'message' => trans('forms.feed.done'),
				'redirect' => url('/manage/devSettings/posts-cats'),
				'callback' => '',
			]);
		}
		else {
			return json_encode([
				'message' => trans('validation.invalid'),
			]);
		}

	}

}
