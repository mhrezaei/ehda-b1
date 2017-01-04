<?php if($model->created_by == Auth::user()->id or !$model->id): ?>
	<div class="text-center m10">
		<button type="button" class="btn btn-info btn-sm" onclick="postSave('draft')"><?php echo e(trans('posts.manage.save_as_draft')); ?></button>
	</div>
<?php elseif($model->is_draft): ?>
	<div class="text-center m10">
		<button type="button" class="btn btn-info btn-sm" onclick="postSave('draft')"><?php echo e(trans('posts.manage.keep_as_draft')); ?></button>
	</div>
<?php else: ?>
	<div class="text-center m10">
		<button type="button" class="btn btn-danger btn-sm" onclick="postSave('draft')"><?php echo e(trans('posts.manage.reject_as_draft')); ?></button>
	</div>
<?php endif; ?>
