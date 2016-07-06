<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8"/>
	<title>@yield('page_title')</title>

	{{-- JQuery --}}
	{!! Html::script ('assets/libs/jquery.js') !!}
	{!! Html::script ('assets/libs/jquery.form.min.js') !!}

	{{-- BOOTSTRAP --}}
	{!! Html::style('assets/libs/bootstrap/css/bootstrap.min.css') !!}
	{!! Html::style('assets/libs/bootstrap/css/bootstrap-rtl.min.css') !!}

	{!! HTML::script ('assets/libs/bootstrap/js/bootstrap.min.js') !!}

	{{-- fonts stuff --}}
	{!! Html::style('assets/css/fontiran.css') !!}
	{!! Html::style('assets/libs/font-awesome/css/font-awesome.min.css') !!}

	{{-- sb-admin --}}
	{!! Html::style('assets/libs/sb-admin/metisMenu.css') !!}
	{!! Html::style('assets/libs/sb-admin/sb-admin-2.css') !!}
	{!! Html::style('assets/libs/sb-admin/timeline.css') !!}
	{!! HTML::script ('assets/libs/sb-admin/Chart.js') !!}
	{!! HTML::script ('assets/libs/sb-admin/frontend.js') !!}
	{!! HTML::script ('assets/libs/sb-admin/metisMenu.js') !!}
	{!! HTML::script ('assets/libs/sb-admin/sb-admin-2.js') !!}

	{{-- Custom --}}
	{!! Html::style('assets/css/manage.min.css') !!}
	{!! HTML::script ('assets/js/forms.js') !!}
	{!! HTML::script ('assets/js/manage.js') !!}


	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>

</head>
<body>
	@yield('body')
</body>
</html>