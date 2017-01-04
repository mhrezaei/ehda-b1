<?php echo Form::open([
	'url'	=> 'auth' ,
	'method'=> 'post',
]); ?>


	<div class="header header-success text-center">
		<h4><?php echo e(trans('manage.login.head_title')); ?></h4>
	</div>

	<div class="content">
		<?php echo $__env->make('manage.login.input' , [
			'name' => 'username' ,
			'icon' => 'face',
			'cap' => trans('validation.attributes.username')
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('manage.login.input' , [
			'name' => 'password' ,
			'icon' => 'lock_outline',
			'cap' => trans('validation.attributes.password'),
			'type' => 'password',
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('manage.login.input' , [
			'name' => 'security' ,
			'icon' => 'visibility',
			'cap' => $captcha['question']
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<input type="hidden" name="key" value="<?php echo e($captcha['key']); ?>">
		
	</div>

	<div class="footer text-center">
		<button type="submit" class="btn btn-success btn-wd btn-lg">
			<?php echo e(trans('forms.button.login')); ?>

		</button>
		<div style="clear: both;"></div>
		<a href="<?php echo e(url('/reset_password')); ?>" class="btn btn-link reset_password_link"><?php echo e(trans('manage.login.reset_password_link')); ?></a>
	</div>

<?php if($errors->all()): ?>
	<div class="alert alert-danger">
		<?php foreach($errors->all() as $error): ?>
			<li><?php echo e($error); ?></li>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<?php echo Form::close(); ?>

