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
		return view('manage.index.0',compact('page' , 'digests'));
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
		$themes = ['orange' , 'pink' , 'violet' , 'green' , 'primary' , 'red' , 'yellow'] ;
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

	public static function topbarNotificationMenu()
	{
		$branches = Branch::all() ;
		$array = [] ;
		$sep = false ;

		//Posts...
		foreach($branches as $branch) {
			if(Auth::user()->can('posts-'.$branch->slug.".publish")) {
				$count = Post::counter($branch->slug, Auth::user()->allowedDomains() , 'pending') ;
				if($count) {
					$count = AppServiceProvider::pd($count) ;
					array_push($array , [
							"manage/posts/$branch->slug/pending" ,
							$branch->title(0)." ".trans('posts.manage.pending')." ( $count ) ",
							$branch->icon ,
					]) ;
				}
			}
		}

		//Cards...
		if(Auth::user()->can('cards.print')) {
			$count = User::counter('card' , 'under_print') ;
			if($count) {
				$count = AppServiceProvider::pd($count) ;
				array_push($array , [
						"manage/cards/browse/under_print" ,
						trans('people.cards.short_title_y')." ".trans('people.cards.manage.under_print')." ( $count ) ",
						'credit-card' ,
				]) ;
			}
		}


		//Volunteers...
		if(Auth::user()->can('volunteers.publish')) {
			$count = User::counter('volunteer' , 'pending') ;
			if($count) {
				$count = AppServiceProvider::pd($count) ;
				array_push($array , [
						"manage/volunteers/browse/pending" ,
						trans('people.volunteers.short_title')." ".trans('people.volunteers.manage.pending')." ( $count ) ",
						'child' ,
				]) ;
			}
		}
		if(Auth::user()->can('volunteers.edit')) {
			$count = User::counter('volunteer' , 'care') ;
			if($count) {
				$count = AppServiceProvider::pd($count) ;
				array_push($array , [
						"manage/volunteers/browse/care" ,
						trans('people.volunteers.short_title')." ".trans('people.volunteers.manage.care')." ( $count ) ",
						'child' ,
				]) ;
			}
		}

		return $array ;
	}

	public static function topbarCreateMenu()
	{
		$branches = Branch::all() ;
		$array = [] ;
		$sep = false ;

		foreach($branches as $branch) {
			if(Auth::user()->can('posts-'.$branch->slug.".create"))
				array_push($array , [
						"manage/posts/$branch->slug/create" ,
						trans('manage.global.create_in' , ['thing'=>$branch->title(0)]),
						$branch->icon ,
				]) ;
		}

		//Other things...
		if(Auth::user()->can('cards.create') or Auth::user()->can('volunteers.create'))
			array_push($array ,['-'] );

		if(Auth::user()->can('cards.create')) {
			array_push($array, [
					"manage/cards/create",
					trans('people.cards.manage.create'),
					'credit-card',
			]);
		}
		if(Auth::user()->can('volunteers.create')) {
			array_push($array , [
					"manage/volunteers/create" ,
					trans('people.volunteers.manage.create') ,
					'child' ,
			]);
		}

		return $array ;

	}



}
