<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\GlobalControllerTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    use GlobalControllerTrait;
    public function index()
    {
        return view('errors.404');
    }

    public function show($id, $url = null)
    {
        $post = Post::find($id);
        if ($post->branch()->template != 'post' or ! $post->isPublished() or ! $post->checkDomain($this->getDomain()))
            return view('errors.404');

        return $post->title;
    }
}
