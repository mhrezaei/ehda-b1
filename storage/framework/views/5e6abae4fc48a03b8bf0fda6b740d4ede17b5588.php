<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<script language="javascript">
		function base_url($ext) {
			if(!$ext) $ext = "" ;
			var $result = '<?php echo e(URL::to('/')); ?>' + $ext ;
			return $result  ;
		}
	</script>

	<?php /* JQuery */ ?>
	<?php echo Html::script ('assets/libs/jquery.js'); ?>


	<?php /* BOOTSTRAP */ ?>
	<?php echo Html::style('assets/libs/bootstrap/css/bootstrap.min.css'); ?>

	<?php echo Html::style('assets/libs/materialkit/css/material-kit.css'); ?>

	<?php echo Html::style('assets/libs/bootstrap/css/bootstrap-rtl.min.css'); ?>


	<?php echo HTML::script ('assets/libs/bootstrap/js/bootstrap.min.js'); ?>

	<?php echo HTML::script ('assets/libs/materialkit/js/material.min.js'); ?>

	<?php echo HTML::script ('assets/libs/materialkit/js/material-kit.js'); ?>


	<?php /* fonts stuff */ ?>
	<?php echo Html::style('assets/css/fontiran.css'); ?>

	<?php echo Html::style('https://fonts.googleapis.com/icon?family=Material+Icons'); ?>

	<?php echo Html::style('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700'); ?>

	<?php echo Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'); ?>  <!-- //@TODO  taha bia ino dorost kon -->

	<?php /* Icons */ ?>
	<link rel="icon" type="image/png" href="favicon.ico">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/images/materialkit/apple-icon.png">

	<?php /* Personal stuff */ ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<style>
		.input-group-addon:first-child{
			border: 0;
		}
		.card-signup .content{
			padding: 0 10px 0 10px;
		}
		.form-control, .header h4, .btn , .alert{
			font-family: 'IRANSans';
		}
	</style>
	<title><?php echo e(trans('manage.old_password.page_title')); ?></title>
</head>

<body class="signup-page">

<div class="wrapper">
	<div class="header header-filter" style="background-image: url('<?php echo e(URL::to('/assets/images/materialkit/city.jpg')); ?>'); background-size: cover; background-position: top center;">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
					<div class="card card-signup">
						<?php echo $__env->yieldContent('form'); ?>
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
