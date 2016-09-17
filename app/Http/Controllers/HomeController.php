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
		return view('site.home.0', compact('news', 'events'));
	}
}
