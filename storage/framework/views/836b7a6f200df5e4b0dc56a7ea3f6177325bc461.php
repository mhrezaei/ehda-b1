<?php if($model->canDelete()): ?>
	<div class="text-center m10">
		<a href="#" class="btn <?php echo e(isset($class) ? $class : 'btn-danger'); ?>  btn-sm" onclick="$('#divDeleteWarning').slideDown('fast')">
			<span class="<?php echo e(isset($class)? 'text-danger' : ''); ?>">
				<?php echo e(trans('forms.button.soft_delete')); ?>

			</span>
		</a>
	</div>
<?php endif; ?>
