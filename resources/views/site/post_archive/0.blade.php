@extends('site.frame.frame')
<title>{{ trans('global.siteTitle') }} | {{ trans('site.global.archive') }}</title>
@section('content')
    <div class="container-fluid">
        @include('site.frame.page_title', [
        'category' => trans('site.global.archive'),
        'parent' => $branch_name,
        'sub' => $category_name
        ])
        @include('site.post_archive.content')
    </div>
@endsection