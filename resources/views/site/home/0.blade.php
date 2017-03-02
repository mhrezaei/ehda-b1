@extends('site.frame.frame')
<title>{{ trans('global.siteTitle') }} | {{ trans('site.global.home_page') }}</title>
@section('meta')
    @include('site.frame.meta',[
        'title' => trans('global.siteTitle'),
        'url' => url(''),
        'image' => url('assets/site/images/header-logo.png'),
    ])
@endsection
@section('content')
    <div class="container-fluid">
        @include('site.home.slider')
        @include('site.home.paragraph')
        @include('site.home.event')
        @include('site.home.slider_event_script')
        @include('site.home.stats')
        @include('site.home.fix_background')
        @include('site.home.news_event_title')
    </div>
@endsection