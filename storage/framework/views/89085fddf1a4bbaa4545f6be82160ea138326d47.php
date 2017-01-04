<?php $__env->startSection('section'); ?>
	<?php echo $__env->make('manage.account.tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php /*
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	*/ ?>
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title"><?php echo e(isset($page[1][1]) ? $page[1][1] : ''); ?></p></div>
	</div>

	<?php /*
	|--------------------------------------------------------------------------
	| Form
	|--------------------------------------------------------------------------
	|
	*/ ?>

	<?php echo $__env->make('forms.opener' , [
		'url' => 'manage/account/save/password',
		'class' => 'js mv20' ,
		'no_validation' => 1
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



		<?php echo $__env->make('forms.input' , [
		    'name' => 'current_password',
		    'type' => 'password',
		    'class' => 'ltr form-required form-default',
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.input' , [
		    'name' => 'new_password',
		    'type' => 'password',
		    'class' => 'ltr form-required form-password',
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.input' , [
			'name' => 'password2',
			'type' => 'password',
			'class' => 'ltr form-required',
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.group-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.button' , [
			'label' => trans('forms.button.save'),
			'shape' => 'success',
			'type' => 'submit' ,
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.feed' , [], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.closer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>