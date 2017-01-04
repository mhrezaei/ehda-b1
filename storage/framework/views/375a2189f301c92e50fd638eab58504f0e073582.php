<?php if(Auth::user()->can('posts-'.$model->branch.'.edit')): ?>
	<div class="text-center m10">
		<button type="button" class="btn btn-success btn-sm" onclick="postSave('publish')">
			<?php echo e(trans('posts.manage.update')); ?>

		</button>
	</div>
<?php endif; ?>

