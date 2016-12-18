<div class="panel panel-toolbar">
	<?php echo $__env->make('manage.frame.widgets.toolbar_button' , [
		'target' => 'manage/devSettings/posts-cats/new' ,
		'type' => 'success' ,
		'caption' => trans('forms.button.add') ,
		'icon' => 'plus-circle' ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<div class="panel panel-default m20">
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
			<tr>
				<td><?php echo e(trans('validation.attributes.title')); ?></td>
				<td><?php echo e(trans('validation.attributes.slug')); ?></td>
				<td><?php echo e(trans('manage.devSettings.posts-cats.have_rss')); ?></td>
				<td><?php echo e(trans('manage.devSettings.posts-cats.have_comments')); ?></td>
				<td><?php echo e(trans('validation.attributes.content')); ?></td>
				<td><?php echo e(trans('manage.devSettings.posts-cats.is_hidden')); ?></td>
			</tr>
			</thead>
			<tbody>
			<?php foreach($model_data as $model): ?>
				<tr>
					<td>
						<a href="<?php echo e(url("manage/devSettings/posts-cats/$model->id")); ?>">
							<?php echo e($model->title); ?>

						</a>
					</td>
					<td><?php echo e($model->slug); ?></td>
					<td>
						<?php if($model->have_rss): ?>
							<span class="fa fa-check text-success"></span>
						<?php else: ?>
							<span class="fa fa-times text-warning"></span>
						<?php endif; ?>
					</td>
					<td>
						<?php if($model->have_comments): ?>
							<span class="fa fa-check text-success"></span>
						<?php else: ?>
							<span class="fa fa-times text-warning"></span>
						<?php endif; ?>
					</td>
					<td><?php echo e($model->is_gallery? trans('manage.devSettings.posts-cats.content_pics') : trans('manage.devSettings.posts-cats.content_text')); ?></td>
					<td>
						<?php if($model->is_hidden): ?>
							<span class="fa fa-check text-success"></span>
						<?php else: ?>
							<span class="fa fa-minus"></span>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>