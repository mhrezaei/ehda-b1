@extends('site.frame.frame')

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