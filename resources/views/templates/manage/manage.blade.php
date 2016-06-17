<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<script language="javascript">
		function base_url($ext) {
			if(!$ext) $ext = "" ;
			var $result = '{{ URL::to('/') }}' + $ext ;
			return $result  ;
		}
	</script>

	{{-- JQuery --}}
	{!! Html::script ('assets/libs/jquery.js') !!}
	{{--{!! HTML::script ('assets/libs/jquery.form.min.js') !!}--}}

	{{--{!! HTML::script ('assets/libs/onepage-scroll/jquery.onepage-scroll.min.js') !!}--}}
	{{--{!! HTML::style ('assets/libs/onepage-scroll/onepage-scroll.css') !!}--}}

	{{-- BOOTSTRAP --}}
	{!! Html::style('assets/libs/bootstrap/css/bootstrap.min.css') !!}
	{!! Html::style('assets/libs/materialkit/css/material-kit.css') !!}
	{!! Html::style('assets/libs/bootstrap/css/bootstrap-rtl.min.css') !!}

	{!! HTML::script ('assets/libs/bootstrap/js/bootstrap.min.js') !!}
	{!! HTML::script ('assets/libs/materialkit/js/material.min.js') !!}
	{!! HTML::script ('assets/libs/materialkit/js/material-kit.js') !!}
	{!! HTML::script ('assets/libs/jquery.animate-colors-min.js') !!}
	{!! HTML::script ('assets/libs/js-persian-cal.min.js') !!}

	{{-- Other libs --}}
	{{--{!! HTML::style('assets/libs/font-awesome/css/font-awesome.min.css') !!}--}}

	{{-- Personal stuff --}}
	{!! Html::style('assets/css/fontiran.css') !!}
	{!! Html::style('assets/css/admin-h.min.css') !!}
	{!! Html::style('assets/css/home-t.min.css') !!}

	{{--{!! HTML::script('assets/js/forms.js') !!}--}}
	{!! HTML::script('assets/js/hadi.js') !!}
	{!! HTML::script('assets/js/taha.js') !!}

	<link rel="icon" type="image/png" href="favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/images/materialkit/apple-icon.png">

	@yield('assets')

	<title>{{ $pageTitle or trans('global.siteTitle') }}</title>
</head>
<body>
@include('templates.manage.navbar')
@include('templates.manage.sidebar')
@yield('content'  )
@yield('modals'   )
</body>
</html>