<?php if($model->canPublish()): ?>
	<div class="text-center m10">
		<a href="#" class="btn btn-warning btn-sm" onclick="$('#divUnpublishWarning').slideDown('fast')">
			<?php echo e(trans('posts.manage.unpublish')); ?>

		</a>
	</div>
<?php endif; ?>
