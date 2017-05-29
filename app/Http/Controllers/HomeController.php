<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\User;
use App\Providers\TahaServiceProvider;
use App\Traits\GlobalControllerTrait;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
	use GlobalControllerTrait;
	public function index()
	{
//		dd(TahaServiceProvider::getHomeControllerRoute());
		$iran_news = Post::selector('iran-news')->where('category_id', 6)->orderBy('published_at', 'desc')->take(5)->get();
		$ngo_news = Post::selector('iran-news')->where('category_id', 8)->orderBy('published_at', 'desc')->take(5)->get();
		$events = Post::selector('event')->orderBy('published_at', 'desc')->take(7)->get();
		$slide_show = Post::selector('slideshows', [$this->domain(), 'global'])->where('category_id', '3')->orderBy('created_at', 'desc')->get();
		$event_slide_show = Post::selector('slideshows')->where('category_id', '4')->get();
		$static_paragraph['top'] = Post::findBySlug('home_page_top_paragraph');
		$static_paragraph['fix_background'] = Post::findBySlug('home_page_fix_background_paragraph');

		return view('site.home.0', compact('iran_news', 'ngo_news', 'events', 'slide_show', 'static_paragraph', 'event_slide_show'));
	}

    public function ramazan()
    {
        $count = User::where('created_by', '303958')->count();
        return view('site.events.0', compact('count'));
	}

    public function ramazan_count()
    {
        $data['count'] = User::where('created_by', '303958')->count();
        $data['status'] = 1;
        $data['sm'] = csrf_token();
        return json_encode($data);
	}
}
