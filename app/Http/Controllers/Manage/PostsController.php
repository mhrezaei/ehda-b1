<?php

namespace App\Http\Controllers\Manage;

use App\models\Branch;
use App\Models\Post;
use App\Models\Post_cat;
use App\Traits\TahaControllerTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PostsController extends Controller
{
    	use TahaControllerTrait;

	private $page = [];

	public function __construct()
	{
		$this->middleware('can:volunteers');
	}

	public function browse($request_branch, $request_tab = 'published')
	{
		//Redirect if $request_branch is a number!
		if(is_numeric($request_branch))
			return $this->modalActions($request_branch , $request_tab) ;

		//Preconditions...
		switch($request_tab) {
			case 'search':
				$permission = "$request_branch.search" ;
				break;
			case 'published' :
				$permission = $request_branch ;
				break;
			case 'pending' :
				$permission = "$request_branch.publish" ;
				break;
			case 'bin' :
				$permission = "$request_branch.bin" ;
				break ;
			default:
				$permission = 'none' ;
		}

		//Permission
		if(!Auth::user()->can($permission))
			return view('errors.403');

		//Preparation...
		$branch = Branch::selectBySlug($request_branch);
		if(!$branch)
			return view('errors.404');


		$page = $this->page ;
		$page[0] = ["posts/".$request_branch , $branch->title() , $request_tab] ;
		$page[1] = ["$request_branch/".$request_tab , trans("posts.manage.$request_tab") , "$request_branch/".$request_tab] ;

		//Model...
		$model_data = Post::selector($request_branch, $request_tab)->orderBy('created_at' , 'desc')->paginate(50);

		//View...
		return view("manage.posts.browse" , compact('page','branch','model_data'));

	}

	public function modalActions($post_id, $view_file)
	{
		if($post_id==0)
			return $this->modalBulkAction($view_file);

		$model = Post::withTrashed()->find($post_id);
		$view = "manage.posts.$view_file";
		$opt = [] ;

		//Particular Actions..
		switch($view_file) { //TODO: Remove if not neccessary!
			case 'permits' :
				$opt['domains'] = Domain::orderBy('title')->get() ;
				break;
		}

		if(!$model) return view('errors.m410');
		if(!View::exists($view)) return view('templates.say' , ['array'=>$view]); //@TODO: REMOVE THIS LINE
		if(!View::exists($view)) return view('errors.m404');

		return view($view , compact('model' , 'opt')) ;

	}

	private function modalBulkAction($view_file)
	{
		$view = "manage.posts.$view_file-bulk" ;

		if(!View::exists($view)) return view('templates.say' , ['array'=>$view]); //@TODO: REMOVE THIS LINE
		if(!View::exists($view)) return view('errors.m404');

		return view($view) ;
	}

	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/


	public function soft_delete(Request $request)
	{
		$model = Post::find($request->id) ;

		if(!Auth::user()->can($model->branch.'.delete')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$done = $model->delete();

		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);

	}

	public function bulk_soft_delete(Request $request)
	{
		//NOTE: Problem: Checking the permission is a little difficult here. Better to disable bulk deletting!
		if(!Auth::user()->can('volunteers.delete')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$deleted = Volunteer::bulkDelete($request->ids , Auth::user()->id);
		return $this->jsonAjaxSaveFeedback($deleted , [
				'success_refresh' => true ,
		]);
	}

	public function undelete(Request $request)
	{
		$model = Post::withTrashed()->find($request->id) ;
		if(!Auth::user()->can($model->branch.'.bin')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$done = $model->restore();

		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);

	}

	public function hard_delete(Request $request)
	{
		$model = Post::withTrashed()->find($request->id) ;
		if(!Auth::user()->can($model->branch.'.bin')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		if(!$model->trashed()) return $this->jsonFeedback(trans('validation.http.Eror403'));
		$done = $model->forceDelete();

		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);

	}



}


