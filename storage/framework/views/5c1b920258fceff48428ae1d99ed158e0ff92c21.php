<div class="panel panel-default w100">
	<div class="panel-heading">
		<?php echo e(trans('posts.manage.creator')); ?>

	</div>

	<?php if($model->id): ?>
		<div class="m10 text-center">
			<?php echo e($model->say('created_by')); ?>

		</div>
		<div class="m10 text-center text-grey">
			<?php echo e($model->say('created_at')); ?>

		</div>
	<?php else: ?>
		<div class="m10 text-center">
			<?php echo e(Auth::user()->fullName()); ?>

		</div>
	<?php endif; ?>

</div>