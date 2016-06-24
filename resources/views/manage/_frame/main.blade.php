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

	{{-- BOOTSTRAP --}}
	{!! Html::style('assets/libs/bootstrap/css/bootstrap.min.css') !!}
{{--	{!! Html::style('assets/libs/materialkit/css/material-kit.css') !!}--}}
	{!! Html::style('assets/libs/bootstrap/css/bootstrap-rtl.min.css') !!}

	{!! HTML::script ('assets/libs/bootstrap/js/bootstrap.min.js') !!}
	{{--{!! HTML::script ('assets/libs/materialkit/js/material.min.js') !!}--}}
	{{--{!! HTML::script ('assets/libs/materialkit/js/material-kit.js') !!}--}}

	{{-- fonts stuff --}}
	{!! Html::style('assets/css/fontiran.css') !!}
	{!! Html::style('https://fonts.googleapis.com/icon?family=Material+Icons') !!}
	{!! Html::style('assets/libs/font-awesome/css/font-awesome.min.css') !!}
	{{--{!! Html::style('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700') !!}--}}
	{{--{!! Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css') !!}--}}

	{{-- Icons --}}
	<link rel="icon" type="image/png" href="favicon.ico">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/images/materialkit/apple-icon.png">

	{{-- Personal stuff --}}
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta content="width=device-width, initial-scale=1" name="viewport"/>

	{!! Html::style('assets/css/manage.min.css') !!}
	{{--{!! Html::script ('assets/js/bs-admin.js') !!}--}}

	<title>{{trans('manage.global.page_title') }}</title>
</head>

<body>
	@yield('body');
</body>

</html>
