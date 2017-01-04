	<div class="header header-success text-center">
		<h4><?php echo e(trans('manage.reset_password.head_title')); ?></h4>
	</div>

	<div class="firstForm">
		<?php echo Form::open([
				'url'	=> 'password/reset_password_process' ,
				'method'=> 'post',
				'class' => 'js',
				'id' => 'reset_password_form'
			]); ?>

		<div class="content">
			<?php echo $__env->make('manage.reset_password.input' , [
			'name' => 'username' ,
			'icon' => 'face',
			'cap' => trans('validation.attributes.username'),
			'class' => 'form-required form-number',
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo $__env->make('manage.reset_password.input' , [
                'name' => 'security' ,
                'icon' => 'visibility',
                'cap' => $captcha['question'],
                'class' => 'form-required form-number',
            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<input type="hidden" name="key" value="<?php echo e($captcha['key']); ?>">
		</div>

		<div class="footer text-center">
			<button type="submit" class="btn btn-success btn-wd btn-lg">
				<?php echo e(trans('forms.button.recovery')); ?>

			</button>
		</div>
		<?php echo $__env->make('forms.feed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

	</div>

	<div class="secondForm" style="display: none;">
		<?php echo Form::open([
				'url'	=> 'password/reset_password_token_process' ,
				'method'=> 'post',
				'class' => 'js',
				'id' => 'reset_password_form_token'
			]); ?>

		<div class="content">
			<input type="hidden" name="national">
			<?php echo $__env->make('manage.reset_password.input' , [
			'name' => 'token' ,
			'icon' => 'visibility',
			'cap' => trans('validation.attributes.token'),
			'class' => 'form-required form-number'
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>

		<div class="footer text-center">
			<button type="submit" class="btn btn-success btn-wd btn-lg">
				<?php echo e(trans('forms.button.recovery')); ?>

			</button>
		</div>
		<?php echo $__env->make('forms.feed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::close(); ?>

	</div>


