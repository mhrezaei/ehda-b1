<?php if($model->status('slug')=='under_review'): ?>
	<div class="text-center m10">
		<button type="button" class="btn btn-primary btn-sm" onclick="postSave('save')"><?php echo e(trans('posts.manage.keep_to_review')); ?></button>
	</div>
<?php else: ?>
	<div class="text-center m10">
		<button type="button" class="btn btn-primary btn-sm" onclick="postSave('save')"><?php echo e(trans('posts.manage.save_to_review')); ?></button>
	</div>
<?php endif; ?>
