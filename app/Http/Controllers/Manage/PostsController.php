<?php

namespace App\Http\Controllers\Manage;

use App\models\Branch;
use App\Models\Post;
use App\Models\Post_cat;
use App\Traits\TahaControllerTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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

		//Redirect if create
		if($request_tab=='create')
			return $this->create($request_branch);

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
			case 'drafts' :
				$permission = "$request_branch.publish" ;
				break;
			case 'my_drafts' :
				$permission = "$request_branch.create" ;
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

		if($view_file=='edit')
			return $this->editor($post_id) ;
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
			case 'delete' :
				return $this->soft_delete($post_id);
			case 'undelete' :
				return $this->undelete($post_id) ;
			case 'unpublish' :
				return $this->unpublish($post_id) ;
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

	private function create($branch_slug)
	{
		//Model...
		$model = new Post() ;
		$model->branch = $branch_slug ;
		$model->domains = '' ;
		if(!$model->branch())
			return view('errors.410');

		//Permission...
		if(!Auth::user()->can("$branch_slug.create"))
			return view('errors.403');

		//Preparetions...
		$page = $this->page ;
		$page[0] = ["posts/$branch_slug" , $model->branch()->title()] ;
		$page[1] = ["posts/create/$branch_slug" , trans('posts.manage.create' , ['thing' => $model->branch()->title(1)])];

		$domains = Auth::user()->domains()->orderBy('title');
		$encrypted_branch = Crypt::encrypt($branch_slug);

		//View...
		return view('manage.posts.editor' , compact('page', 'model' , 'domains' , 'encrypted_branch'));

	}

	public function editor($post_id)
	{
		//Model...
		$model = Post::withTrashed()->find($post_id) ; 
		if(!$model)
			return view('errors.410');

		//Permission...
		if(!$model->canEdit())
			return view('errors.403');

		//Preparations...
		$page = $this->page ;
		$page[0] = ["posts/".$model->branch , $model->branch()->title() ] ;
		$page[1] = ["posts/$post_id/edit" , trans('posts.manage.edit') ] ;

		$domains = Auth::user()->domains()->orderBy('title') ;
		$encrypted_branch = Crypt::encrypt($model->branch);

		//View...
		return view('manage.posts.editor' , compact('page','model' , 'domains' , 'encrypted_branch'));

	}
	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	private function unpublish($post_id)
	{
		//Preparations...
		$model = Post::find($post_id) ;
		if(!$model) return $this->jsonFeedback() ;

		if(!Auth::user()->can($model->branch.".publish",$model->domains))
			return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		//Action...
		if($model->unpublish())
			echo ' <div class="alert alert-success">'. trans('forms.feed.done') .'</div> ';
		else
			echo ' <div class="alert alert-danger">'. trans('forms.feed.error') .'</div> ';

	}


	public function soft_delete($post_id)
	{

		//Preparations...
		$model = Post::find($post_id) ;
		if(!$model) return $this->jsonFeedback() ;

		if(!Auth::user()->can($model->branch.".delete",$model->domains))
			return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		if(!Auth::user()->can($model->branch.'.delete')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		//Action...
		if($model->delete())
			echo ' <div class="alert alert-success">'. trans('forms.feed.done') .'</div> ';
		else
			echo ' <div class="alert alert-danger">'. trans('forms.feed.error') .'</div> ';

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

	public function undelete($post_id)
	{
		$model = Post::withTrashed()->find($post_id) ;
		if(!$model) return $this->jsonFeedback() ;

		if(!Auth::user()->can($model->branch.".delete",$model->domains))
			return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		//Action...
		if($model->restore())
			echo ' <div class="alert alert-success">'. trans('forms.feed.done') .'</div> ';
		else
			echo ' <div class="alert alert-danger">'. trans('forms.feed.error') .'</div> ';

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

	public function save(Requests\PostSaveRequest $request)
	{
		$data = $request->toArray() ;
		$action = $data['action'] ;
		unset($data['action']);
		$now = Carbon::now()->toDateTimeString();
		$user = Auth::user() ;
		$user_id = $user->id ;
		$success_redirect = null ;
		$delete_id = 0 ;

		$publish_date = new Carbon($data['publish_date']);
		unset($data['publish_date']);

		//if new record...
		if(!$data['id']) {
			switch($action) {
				case 'preview' :
				case 'draft' :
					$success_redirect = 'manage/posts/-ID-/edit' ;
					$data['is_draft'] = 1 ;
					break;

				case 'save' :
					$success_redirect = 'manage/posts/'.$request->branch.'/my_posts' ;
					break;

				case 'schedule' :
					$success_redirect = 'manage/posts/'.$request->branch.'/my_posts' ;
					$data['published_at'] = $publish_date->toDateTimeString() ;
					$data['published_by'] = $user_id ;
					break;

				case 'publish' :
					$success_redirect = 'manage/posts/'.$request->branch.'/my_posts' ;
					$data['published_at'] = $now ;
					$data['published_by'] = $user_id ;
					break;
			}
		}

		//if modified record...
		if($data['id']) {
			$model = Post::withTrashed()->find($data['id']);
			if(!$model)
				return $this->jsonFeedback();

			switch($action) {
				case 'preview' :
				case 'draft' :
					$data['is_draft'] = 1 ;
					if(!$model->is_draft) {
						$success_redirect = 'manage/posts/-ID-/edit' ;
						$data['copy_of'] = $data['id'] ;
						$data['id'] = 0 ;
					}
					break;

				case 'save' :
					$success_redirect = 'manage/posts/'.$request->branch.'/my_posts' ;
					if(!$model->is_draft) {
						$data['copy_of'] = $data['id'] ;
						$data['id'] = 0 ;
					}
					break;

				case 'schedule' :
					$success_redirect = 'manage/posts/'.$request->branch.'/my_posts' ;
					if($model->isPublished())
						return $this->jsonFeedback();
					$data['published_at'] = $publish_date->toDateTimeString() ;
					$data['published_by'] = $user_id ;
					break;

				case 'publish' :
					$success_redirect = 'manage/posts/'.$request->branch.'/my_posts' ;
					$data['published_at'] = $now ;
					$data['published_by'] = $user_id ;
					break;

			}


			//Replacing the draft with an existing record
			if($model->copy_of) {
				if(in_array($action, ['preview', 'draft', 'save'])) {
					$data['copy_of'] = $model->copy_of;
					$data['published_by'] = $model->published_by ;
				}
				else {
					$delete_id = $data['id']  ;
 					$data['id'] = $model->copy_of ;
				}
			}

		}

		//Reading the domains...
		$data['domains'] = '|' ;
		foreach($data as $index => $item) {
			if(str_contains($index,'domain_')) {
				unset($data[$index]);
				if($item+0)
					$data['domains'] .= $index . '|' ;
			}
		}
		$data['domains'] = str_replace('domain_',null,$data['domains']);

		if($data['domains'] == '|')
			return $this->jsonFeedback(trans('posts.manage.error_domain_not_selected'));
		if(!$user->can('*',$data['domains']))
			return $this->jsonFeedback() ;
		if(isset($model) and !$user->can('*',$model->domains))
			return $this->jsonFeedback() ;


		//Save...
		$is_saved = Post::store($data) ;

		//Deleting draft record if required...
		if($is_saved and $delete_id>0)
			Post::where('id',$delete_id)->forceDelete() ;

		//Choosing the redirection...
		$success_redirect = str_replace('-ID-' , $is_saved , $success_redirect );

		return $this->jsonAjaxSaveFeedback($is_saved , [
			'success_redirect' => $success_redirect ,
		]);



	}


}

