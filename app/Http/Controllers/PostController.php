<?php

namespace App\Http\Controllers;

use App\models\Branch;
use App\Models\Category;
use App\models\Meta;
use App\Models\Post;
use App\Traits\GlobalControllerTrait;
use App\Traits\TahaControllerTrait;
use App\Traits\TahaMetaTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use GlobalControllerTrait;
    use TahaControllerTrait;
    use TahaMetaTrait;

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

        if (! $post or $post->branch()->template != 'post' or ! $post->isPublished())
            return view('errors.404');

        return view('site.show_post.0', compact('post'));
    }

    public function archive($branch = 'searchable', $category = 'all')
    {
        if ($branch and $branch != 'searchable')
            $branch_name = Branch::findBySlug($branch)->plural_title;
        else
            $branch_name = null;

        if ($category and $category != 'all')
        {
            $category_name = Category::findBySlug($category)->title;
            $category_id = Category::findBySlug($category)->id;
        }
        else
        {
            $category_name = trans('site.global.all_post');
            $category_id = 0;
        }

        $archive = Post::selector($branch);
        if ($category_id)
        {
            $archive = $archive->where('category_id', $category_id);
        }

        $archive = $archive->where('published_at', '<=', Carbon::now()->toDateTimeString())
            ->orderBy('published_at', 'desc')
            ->paginate(20);

        return view('site.post_archive.0', compact('branch_name', 'category_name', 'archive'));
    }

    public function faq()
    {
        $faq = Post::selector('faq')
            ->where('category_id', 5)
            ->where('published_at', '<=', Carbon::now()->toDateTimeString())
            ->orderBy('id', 'asc')->get();

        if (! $faq)
            redirect(url());
        
        return view('site.faq.0', compact('faq'));
    }

    public function faq_new(Requests\site\FaqNewQsRequest $request)
    {
        $data = $request->toArray();


        $store['text'] = $data['text'];
        $store['branch'] = 'users_qs';
        $store['domains'] = 'free';
        $store['published_at'] = Carbon::now()->toDateTimeString();

        if (strlen($data['title']) > 0)
        {
            $store['title'] = $data['title'];
        }
        else
        {
            $store['title'] = trans('site.global.does_not_have');
        }

        if (Auth::check())
        {
            $store['created_by'] = Auth::user()->id;
            $store['published_by'] = Auth::user()->id;
        }

        $post = Post::store($store);
        $post = Post::find($post);

        $post->meta('full_name', $data['full_name']);
        $post->meta('email', $data['email']);
        $post->meta('tel_mobile', $data['tel_mobile']);
        
        return $this->jsonFeedback(null, [
            'ok' => 1,
            'message' => trans('site.global.your_question_record_successfully'),
            'callback' => 'faq_new_reset_form()',
        ]);

    }

    public function angels()
    {
        return view('site.angels.0');
    }
}
