<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
	public function index()
	{
		$news = Post::selector('iran-news')->orderBy('published_at', 'desc')->take(5)->get();
		$events = Post::selector('event')->orderBy('published_at', 'desc')->take(5)->get();
		$slide_show = Post::selector('slideshows')->where('category_id', '3')->get();
		$static_paragraph['top'] = Post::findBySlug('home_page_top_paragraph');
		$static_paragraph['fix_background'] = Post::findBySlug('home_page_fix_background_paragraph');

		return view('site.home.0', compact('news', 'events', 'slide_show', 'static_paragraph'));
	}
}
