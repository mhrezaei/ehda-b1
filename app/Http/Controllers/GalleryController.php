<?php

namespace App\Http\Controllers;

use App\models\Branch;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function show_categories($branch)
    {
        $branch_data = Branch::findBySlug($branch);
        if (! $branch_data)
            return view('errors.404');
        
        return view('site.gallery.show_categories.0', compact('branch_data'));
    }

    public function show_categories_posts($category)
    {
        $category = Category::findBySlug($category);
        if (! $category)
            return view('errors.404');
        
        return view('site.gallery.show_categories_posts.0', compact('category'));
    }

    public function show_gallery($id, $url = null)
    {
        $gallery = Post::find($id);
        if (! $gallery)
            return view('errors.404');

        return view('site.gallery.show_gallery.0', compact('gallery'));
    }
}
