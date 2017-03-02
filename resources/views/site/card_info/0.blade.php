@extends('site.frame.frame')
<title>{{ trans('global.siteTitle') }} | {{ $post->title }}</title>
@section('meta')
    @include('site.frame.meta',[
        'title' => $post->say('title'),
        'url' => url('organ_donation_card'),
        'image' => url('/assets/site/images/cardMini.png'),
        'description' => $post->say('abstract'),
    ])
@endsection
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