<?php

namespace App\Http\Controllers;

use App\models\Branch;
use App\Models\Category;
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
        if (is_numeric($id))
            $post = Post::find($id);
        else
            $post = Post::findBySlug(urldecode($id));

        if (! $post or $post->branch()->template != 'post' or ! $post->isPublished() or ! $post->checkDomain($this->getDomain()))
            return view('errors.404');

        return view('site.show_post.0', compact('post'));
    }

    public function archive($branch = 'all', $category = 'all')
    {
        $post = Post::find(36) ;

        return view('templates.say' , ['array'=>$post->say('featured_image')]);


        if ($branch and $branch != 'all')
            $branch_name = Branch::findBySlug($branch)->plural_title;
        else
            $branch_name = null;

        if ($category and $category != 'all')
            $category_name = Category::findBySlug($category)->title;
        else
            $category_name = trans('site.global.all_post');

        $archive = Post::selector()->paginate(2);

        return view('templates.say' , ['array'=>$archive]);


        return view('site.post_archive.0', compact('branch_name', 'category_name', 'archive'));
    }
}
