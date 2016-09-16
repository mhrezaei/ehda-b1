@extends('site.frame.frame')
<title>{{ trans('global.siteTitle') }} | {{ $post->title }}</title>
@section('content')
    <div class="container-fluid">
        @include('site.frame.page_title', [
        'category' => $post->say('header'),
        'parent' => $post->say('category_title'),
        'sub' => $post->title
        ])
        @include('site.card_info.card_info_content')
    </div>
@endsection