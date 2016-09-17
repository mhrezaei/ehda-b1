@extends('site.frame.frame')
<title>{{ trans('global.siteTitle') }} | @pd($post->title)</title>
@section('content')
    <div class="container-fluid">
        @include('site.frame.page_title', [
        'category' => $post->say('header'),
        'parent' => $post->say('category_title'),
        'sub' => $post->title
        ])
        @include('site.show_post.content')
    </div>
@endsection