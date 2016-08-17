@extends('site.frame.frame')

@section('content')
    <div class="container-fluid">
        @include('site.site.home.slider')
        @include('site.site.home.paragraph')
        @include('site.site.home.event')
        @include('site.site.home.slider_event_script')
        @include('site.home.stats')
        @include('site.home.fix_background')
    </div>
@endsection