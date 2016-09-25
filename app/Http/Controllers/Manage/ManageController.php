<?php

namespace App\Http\Controllers\Manage;

use App\models\Branch;
use App\Models\Post;
use App\Models\User;
use App\Providers\AppServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class ManageController extends Controller
{
	private $page = array() ;

	public function __construct()
	{
		$this->page[0] = ['index' , trans('manage.modules.index')] ;
	}


	public function index()
	{
		//Preparetions...
		$page = $this->page ;
		$digests = $this->index_digests() ;

		//View...
		return view('manage.index.index',compact('page' , 'digests'));
	}

	private function index_digests()
	{
		$digests = [] ;

		$cards = User::counter('card', 'active' , 'global') ;
		array_push($digests , [
				'icon' => 'credit-card' ,
				'number' => number_format($cards),
				'text' => trans('people.cards.full_title') ,
				'theme' => 'green' ,
				'link' => Auth::user()->can('cards.browse')? url('/manage/cards/browse/') : 'NO' ,
		]);

		$volunteers = User::counter('volunteer', 'active' , 'global') ;
		array_push($digests , [
				'icon' => 'child' ,
				'number' => number_format($volunteers),
				'text' => trans('people.volunteer') ,
				'theme' => 'primary' ,
				'link' => Auth::user()->can('volunteers.browse')? url('/manage/volunteers/browse/') : 'NO' ,
		]);

		$branches = Branch::selector('digest')->get();
		$themes = ['orangered' , 'pink' , 'violet' , 'green' , 'primary' , 'red' , 'yellow'] ;
		foreach($branches as $key => $branch) {
			$posts = Post::counter($branch->slug);
			array_push($digests , [
				'icon' => $branch->icon ,
				'number' => number_format($posts),
				'text' => $branch->title(1) ,
				'theme' => $themes[ $key%sizeof($themes) ] ,
				'link' => Auth::user()->can("posts-$branch->slug.browse")? url("/manage/posts/$branch->slug") : 'NO' ,
			]);

		}


		return $digests ;

	}




}
