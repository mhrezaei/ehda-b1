<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Traits\GlobalControllerTrait;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
	use GlobalControllerTrait;
	public function index()
	{
		$news = Post::selector('iran-news')->orderBy('published_at', 'desc')->take(5)->get();
		$events = Post::selector('event')->orderBy('published_at', 'desc')->take(5)->get();
		$slide_show = Post::selector('slideshows', [$this->domain(), 'global'])->where('category_id', '3')->orderBy('created_at', 'desc')->get();
		$event_slide_show = Post::selector('slideshows')->where('category_id', '4')->get();
		$static_paragraph['top'] = Post::findBySlug('home_page_top_paragraph');
		$static_paragraph['fix_background'] = Post::findBySlug('home_page_fix_background_paragraph');

		return view('site.home.0', compact('news', 'events', 'slide_show', 'static_paragraph', 'event_slide_show'));
	}
}
