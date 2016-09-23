@extends('site.frame.frame')
<title>{{ trans('global.siteTitle') }} | {{ trans('site.know_menu.faq') }}</title>
@section('content')
    <div class="container-fluid">
        @include('site.frame.page_title', [
        'category' => trans('site.menu.know'),
        'parent' => trans('site.know_menu.faq'),
        ])
        @include('site.faq.faq_content')
    </div>
@endsection