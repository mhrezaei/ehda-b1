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
	{!! Html::style('assets/libs/materialkit/css/material-kit.css') !!}
	{!! Html::style('assets/libs/bootstrap/css/bootstrap-rtl.min.css') !!}

	{!! HTML::script ('assets/libs/bootstrap/js/bootstrap.min.js') !!}
	{!! HTML::script ('assets/libs/materialkit/js/material.min.js') !!}
	{!! HTML::script ('assets/libs/materialkit/js/material-kit.js') !!}

	{{-- fonts stuff --}}
	{!! Html::style('assets/css/fontiran.css') !!}
	{!! Html::style('https://fonts.googleapis.com/icon?family=Material+Icons') !!}
	{!! Html::style('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700') !!}
	{!! Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css') !!}

	{{-- Icons --}}
	<link rel="icon" type="image/png" href="favicon.ico">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/images/materialkit/apple-icon.png">

	{{-- Personal stuff --}}
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<style>
		.input-group-addon:first-child{
			border: 0;
		}
		.card-signup .content{
			padding: 0 10px 0 10px;
		}
		.form-control, .header h4, .btn{
			font-family: 'IRANSans';
		}
	</style>
	<title>{{ $pageTitle or trans('login.pageTitle') }}</title>
</head>

<body class="signup-page">

<div class="wrapper">
	<div class="header header-filter" style="background-image: url('{{ URL::to('/assets/images/materialkit/city.jpg') }}'); background-size: cover; background-position: top center;">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
					<div class="card card-signup">
						@yield('form')
					</div>
				</div>
			</div>
		</div>

		<footer class="footer">
			<div class="container">
				<nav class="pull-left">
				</nav>
			</div>
		</footer>

	</div>

</div>


</body>

<script type="text/javascript">
	$().ready(function(){
		// the body of this function is in assets/material-kit.js
		$(window).on('scroll', materialKit.checkScrollForTransparentNavbar);
	});
</script>

</body>
</html>
