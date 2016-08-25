@extends('site.frame.frame')
<title>{{ trans('global.siteTitle') }} | {{ trans('site.global.card_info_page') }}</title>
@section('content')
    <div class="container-fluid">
        @include('site.frame.page_title', [
        'category' => trans('site.menu.join'),
        'parent' => trans('site.know_menu.organ_donation_card'),
        'sub' => trans('site.global.card_info_page')
        ])
        @include('site.card_info.card_info_content')
    </div>
@endsection