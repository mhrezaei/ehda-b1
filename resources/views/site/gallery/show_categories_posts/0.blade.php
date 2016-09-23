@extends('site.frame.frame')
<title>{{ trans('global.siteTitle') }} | {{ $branch_data->title }}</title>
@section('content')
    <div class="container-fluid">
        @include('site.frame.page_title', [
        'category' => $branch_data->header_title,
        'parent' => $branch_data->title,
        ])
        @include('site.gallery.show_categories.show_categories_content')
    </div>
@endsection