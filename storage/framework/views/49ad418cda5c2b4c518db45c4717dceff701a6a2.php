<?php if($model->branch()->hasFeature('preview')): ?>
	<div class="text-center m10">
		<a href="<?php echo e($model->say('preview')); ?>" target="_blank" class="btn btn-link btn-sm">
			<?php echo e(isset($text) ? $text : trans('posts.manage.preview_in_site')); ?>

		</a>
	</div>
<?php endif; ?>