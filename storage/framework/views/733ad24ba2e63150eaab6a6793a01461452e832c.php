<?php echo Form::open([
	'url'	=> 'password/auth_password' ,
	'method'=> 'post',
]); ?>


	<div class="header header-success text-center">
		<h4><?php echo e(trans('manage.old_password.head_title')); ?></h4>
	</div>

	<div class="alert alert-info"><?php echo e(trans('manage.old_password.change_password_msg')); ?></div>

	<div class="content">
		<?php echo $__env->make('manage.old_password.input' , [
			'name' => 'password' ,
			'icon' => 'lock_outline',
			'cap' => trans('validation.attributes.password'),
			'type' => 'password'
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('manage.old_password.input' , [
			'name' => 'password2' ,
			'icon' => 'lock_outline',
			'cap' => trans('validation.attributes.password2'),
			'type' => 'password',
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>

	<div class="footer text-center">
		<button type="submit" class="btn btn-success btn-wd btn-lg">
			<?php echo e(trans('forms.button.save')); ?>

		</button>
	</div>

<?php if($errors->all()): ?>
	<div class="alert alert-danger">
		<?php foreach($errors->all() as $error): ?>
			<li><?php echo e($error); ?></li>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<?php echo Form::close(); ?>

