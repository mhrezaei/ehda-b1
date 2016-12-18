<div class="panel panel-default w100">
	<div class="panel-heading">
		<?php echo e(trans('posts.manage.current_status')); ?>

	</div>

	<div class="text-center m10 alert alert-<?php echo e($model->status('color')); ?>">
		<?php echo e($model->status('text')); ?>

	</div>
</div>