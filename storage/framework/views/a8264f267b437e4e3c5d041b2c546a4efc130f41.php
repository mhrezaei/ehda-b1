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

	<?php /*<?php echo HTML::script ('assets/libs/jquery.form.min.js'); ?>*/ ?>

	<?php /*<?php echo HTML::script ('assets/libs/onepage-scroll/jquery.onepage-scroll.min.js'); ?>*/ ?>
	<?php /*<?php echo HTML::style ('assets/libs/onepage-scroll/onepage-scroll.css'); ?>*/ ?>

	<?php /* BOOTSTRAP */ ?>
	<?php echo Html::style('assets/libs/bootstrap/css/bootstrap.min.css'); ?>

	<?php echo Html::style('assets/libs/materialkit/css/material-kit.css'); ?>

	<?php echo Html::style('assets/libs/bootstrap/css/bootstrap-rtl.min.css'); ?>


	<?php echo Html::script ('assets/libs/bootstrap/js/bootstrap.min.js'); ?>

	<?php echo Html::script ('assets/libs/materialkit/js/material.min.js'); ?>

	<?php echo Html::script ('assets/libs/materialkit/js/material-kit.js'); ?>

	<?php echo Html::script ('assets/libs/jquery.animate-colors-min.js'); ?>

	<?php echo Html::script ('assets/libs/js-persian-cal.min.js'); ?>


	<?php /* Other libs */ ?>
	<?php /*<?php echo Html::style('assets/libs/font-awesome/css/font-awesome.min.css'); ?>*/ ?>

	<?php /* Personal stuff */ ?>
	<?php echo Html::style('assets/css/fontiran.css'); ?>

	<?php echo Html::style('assets/css/manage-h.min.css'); ?>

	<?php echo Html::style('assets/css/home-t.min.css'); ?>


	<?php /*<?php echo Html::script('assets/js/forms.js'); ?>*/ ?>
	<?php echo Html::script('assets/js/hadi.js'); ?>

	<?php echo Html::script('assets/js/taha.js'); ?>


	<link rel="icon" type="image/png" href="favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/images/materialkit/apple-icon.png">

	<?php echo $__env->yieldContent('assets'); ?>

	<title><?php echo e(isset($pageTitle) ? $pageTitle : trans('global.siteTitle')); ?></title>
</head>
<body>
<?php echo $__env->make('templates.manage.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('templates.manage.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('content'  ); ?>
<?php echo $__env->yieldContent('modals'   ); ?>
</body>
</html>