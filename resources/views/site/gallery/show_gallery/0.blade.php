@extends('site.frame.frame')
<title>{{ trans('global.siteTitle') }} | {{ $gallery->title }}</title>
@section('content')
    <div class="container-fluid">
        @include('site.frame.page_title', [
        'category' => $gallery->say('header'),
        'parent' => $gallery->say('category_name'),
        'sub' => $gallery->title
        ])
        @include('site.gallery.show_gallery.show_gallery_content')
    </div>
@endsection