<?php /*
|--------------------------------------------------------------------------
| Delete Warning
|--------------------------------------------------------------------------
|
*/ ?>
<div id="divDeleteWarning" class="alert alert-danger row w95 margin-auto noDisplay">
	<div class="col-md-1 p10 f45 text-center">
		<div class="fa fa-warning"></div>
	</div>
	<div class="col-md-11">
		<div class="m10">
			<?php if($model->isPublished()): ?>
				<?php echo e(trans('posts.manage.confirm_published_delete')); ?>

			<?php else: ?>
				<?php echo e(trans('posts.manage.confirm_delete')); ?>

			<?php endif; ?>
		</div>
		<div class="m10">
			<?php echo e(trans('forms.general.ask_confirm')); ?>

		</div>
		<div class="m10">
			<button class="btn btn-danger w20" onclick="postChange('delete')"><?php echo e(trans('forms.button.soft_delete')); ?></button>
			<button class="btn btn-link w10" onclick="$('#divDeleteWarning').slideUp('fast')"><?php echo e(trans('forms.button.oh_no')); ?></button>
		</div>
	</div>
</div>


<?php /*
|--------------------------------------------------------------------------
| Unpublish Warning
|--------------------------------------------------------------------------
|
*/ ?>
<div id="divUnpublishWarning" class="alert alert-warning row w95 margin-auto noDisplay">
	<div class="col-md-1 p10 f45 text-center">
		<div class="fa fa-warning"></div>
	</div>
	<div class="col-md-11">
		<div class="m10">
			<?php echo e(trans('posts.manage.confirm_unpublish')); ?>

		</div>
		<div class="m10">
			<?php echo e(trans('forms.general.ask_confirm')); ?>

		</div>
		<div class="m10">
			<button class="btn btn-warning w20" onclick="postChange('unpublish')"><?php echo e(trans('posts.manage.unpublish')); ?></button>
			<button class="btn btn-link w10" onclick="$('#divUnpublishWarning').slideUp('fast')"><?php echo e(trans('forms.button.oh_no')); ?></button>
		</div>
	</div>
</div>