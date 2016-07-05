<?php

namespace App\Http\Controllers\Manage;

use App\Models\Post_cat;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class DevSettingsController extends Controller
{
	private $page = array() ;
	public function __construct()
	{
		$this->middleware('can:dev');

		$this->page[0] = ['devSettings'] ;
	}

	public function index($request_tab='posts-cats')
	{
		//Preparetions...
		$page = $this->page ;
		$page[1] = [$request_tab] ;
		$sub_method = str_replace('-','','index_'.$request_tab) ;
		if(!method_exists($this,$sub_method)) return view('errors.404');

		//Model...
		$model_data = $this->$sub_method() ;

		//View...
		return view("manage.settings.dev",compact('page','model_data'));

	}

	private function index_postscats($parent_id=0)
	{
		$model = Post_cat::where('parent_id',$parent_id)->orderBy('title')->get();
		return $model ;
	}

	public function add($request_tab)
	{
		//Preparetion...
		$page = $this->page ;
		$page[1] = [$request_tab] ;
		$page[2] = ['add' ] ;
		$view = "manage.settings.".$request_tab."_add" ;

		//View...
		if(!View::exists($view)) return view('errors.404');
		return view($view,compact('page'));
	}

}
