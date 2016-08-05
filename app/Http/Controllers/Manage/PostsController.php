<?php

namespace App\Http\Controllers\Manage;

use App\Models\Post;
use App\Models\Post_cat;
use App\Traits\TahaControllerTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
		$branch = Post_cat::selectBySlug($request_branch);
		if(!$branch)
			return view('errors.404');

		$page = $this->page ;
		$page[0] = ["posts/".$request_branch , $branch->title , $request_tab] ;
		$page[1] = ["$request_branch/".$request_tab , trans("posts.manage.$request_tab") , "$request_branch/".$request_tab] ;

		//Model...
		$model_data = Post::selector($request_branch, $request_tab)->orderBy('created_at' , 'desc')->paginate(50);

		//View...
		return view("manage.posts.browse" , compact('page','branch','model_data'));

	}

}


