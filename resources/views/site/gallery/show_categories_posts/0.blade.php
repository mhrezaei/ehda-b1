@extends('site.frame.frame')
<title>{{ trans('global.siteTitle') }} | {{ $category->title }}</title>
@section('content')
    <div class="container-fluid">
        @include('site.frame.page_title', [
        'category' => $category->branch->header_title,
        'parent' => $category->title,
        ])
        @include('site.gallery.show_categories_posts.show_categories_content')
    </div>
@endsection