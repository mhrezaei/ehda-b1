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

	<?php echo Html::style('assets/libs/bootstrap/css/bootstrap-rtl.min.css'); ?>


	<?php echo HTML::script ('assets/libs/bootstrap/js/bootstrap.min.js'); ?>


	<?php /* Other libs */ ?>
	<?php /*<?php echo HTML::style('assets/libs/font-awesome/css/font-awesome.min.css'); ?>*/ ?>

	<?php /* Personal stuff */ ?>
	<?php echo Html::style('assets/css/fontiran.css'); ?>

	<?php echo Html::style('assets/css/home-h.min.css'); ?>

	<?php echo Html::style('assets/css/home-t.min.css'); ?>


	<?php /*<?php echo HTML::script('assets/js/forms.js'); ?>*/ ?>
	<?php echo HTML::script('assets/js/hadi.js'); ?>

	<?php echo HTML::script('assets/js/taha.js'); ?>


	<?php echo $__env->yieldContent('assets'); ?>

	<title><?php echo e(isset($pageTitle) ? $pageTitle : trans('global.siteTitle')); ?></title>
</head>
<body>

<?php echo $__env->yieldContent('content'  ); ?>
<?php echo $__env->yieldContent('modal'); ?>
</body>
</html>