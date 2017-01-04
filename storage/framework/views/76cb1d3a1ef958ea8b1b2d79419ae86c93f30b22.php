<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8"/>
	<title><?php echo $__env->yieldContent('page_title'); ?></title>

	<script language="javascript">
		function assets($additive) {
			if(!$additive) $additive = '' ;
			return url('assets/'+$additive); 
		}
		function url($additive) {
			if(!$additive) $additive = '' ;
			return '<?php echo e(url('-additive-')); ?>'.replace('-additive-',$additive) ;
		}
	</script>

	<?php /* JQuery */ ?>
	<?php echo Html::script ('assets/libs/jquery.js'); ?>

	<?php echo Html::script ('assets/libs/jquery.form.min.js'); ?>


	<?php /* BOOTSTRAP */ ?>
	<?php echo Html::style('assets/libs/bootstrap/css/bootstrap.min.css'); ?>

	<?php echo Html::style('assets/libs/bootstrap/css/bootstrap-rtl.min.css'); ?>

	<?php echo HTML::script ('assets/libs/bootstrap/js/bootstrap.min.js'); ?>


	<?php /* fonts stuff */ ?>
	<?php echo Html::style('assets/css/fontiran.css'); ?>

	<?php echo Html::style('assets/libs/font-awesome/css/font-awesome.min.css'); ?>


	<?php /* TinyMCE*/ ?>
	<?php echo HTML::script ('assets/libs/tinymce/tinymce.min.js'); ?>

	<?php echo HTML::script ('assets/libs/tinymce/tinymce.starter.js'); ?>


	<?php /* sb-admin */ ?>
	<?php echo Html::style('assets/libs/sb-admin/metisMenu.css'); ?>

	<?php echo Html::style('assets/libs/sb-admin/sb-admin-2.css'); ?>

	<?php echo Html::style('assets/libs/sb-admin/timeline.css'); ?>

	<?php echo HTML::script ('assets/libs/sb-admin/Chart.js'); ?>

	<?php /*<?php echo HTML::script ('assets/libs/sb-admin/frontend.js'); ?>*/ ?>
	<?php echo HTML::script ('assets/libs/sb-admin/metisMenu.js'); ?>

	<?php echo HTML::script ('assets/libs/sb-admin/sb-admin-2.js'); ?>


	<?php /* Bootstrap-select */ ?>
	<?php echo Html::style('assets/libs/bootstrap-select/bootstrap-select.min.css'); ?>

	<?php echo HTML::script ('assets/libs/bootstrap-select/bootstrap-select.min.js'); ?>

	<?php echo HTML::script ('assets/libs/bootstrap-select/defaults-fa_IR.min.js'); ?>


	<?php /* Datepicker */ ?>
	<?php echo HTML::script ('assets/site/js/persian-date-0.1.8.min.js'); ?>

	<?php echo HTML::script ('assets/site/js/persian-datepicker-0.4.5.min.js'); ?>

	<?php echo HTML::style ('assets/site/css/persian-datepicker-0.4.5.min.css'); ?>


	<?php echo HTML::style ('assets/libs/datepicker/js-persian-cal.css'); ?>

	<?php echo HTML::script ('assets/libs/datepicker/js-persian-cal.js'); ?>


	<?php /* Jquery Sortable */ ?>
<?php /*	<?php echo HTML::script ('assets/libs/jquery-sortable/jquery-sortable.js'); ?>*/ ?>


	<?php /* Laravel File-Manage */ ?>
	<?php echo HTML::script ('/vendor/laravel-filemanager/js/lfm.js'); ?>


	<?php /* Custom */ ?>
	<?php echo Html::style('assets/css/manage.min.css'); ?>

	<?php echo HTML::script ('assets/js/forms.js'); ?>

	<?php echo HTML::script ('assets/js/manage.js'); ?>



	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>

</head>
<body>
	<?php echo $__env->yieldContent('body'); ?>
</body>
</html>