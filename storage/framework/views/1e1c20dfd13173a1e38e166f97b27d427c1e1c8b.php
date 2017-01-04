<?php if($model_data->count() == 0): ?>
	<tr>
		<td colspan="<?php echo e(isset($colspan) ? $colspan : '10'); ?>">
			<div class="null">
				<?php echo e(trans('forms.feed.nothing')); ?>

			</div>
		</td>
	</tr>
<?php endif; ?>