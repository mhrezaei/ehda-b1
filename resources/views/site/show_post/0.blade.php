@extends('site.frame.frame')
<title>{{ trans('global.siteTitle') }} | @pd($post->title)</title>
@section('meta')
    @include('site.frame.meta',[
        'title' => $post->say('title'),
        'url' => $post->say('link'),
        'image' => $post->say('featured_image'),
        'description' => $post->say('abstract'),
    ])
@endsection
@section('content')
    <div class="container-fluid">
        <?php
        if ($post->branch == 'statics')
            {
                $title = $post->say('title');
                $parent = $post->say('category_name');
            }
            else
            {
                $title = $post->say('category_name');
                $parent = $post->branch()->plural_title;
            }
        ?>
        @include('site.frame.page_title', [
        'category' => $post->say('header'),
        'parent' => $parent,
        'sub' => $title
        ])
        @include('site.show_post.content')
    </div>
@endsection