<?php $__env->startSection('section'); ?>
	<?php echo $__env->make('manage.settings.tabs_dev', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php /*
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	*/ ?>
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title"><?php echo e(trans('manage.devSettings.branches.trans')); ?></p></div>
		<div class="col-md-8 tools">
			<?php echo $__env->make('manage.frame.widgets.toolbar_button' , [
				'target' => "masterModal('".url('manage/devSettings/branches/0/edit')."')" ,
				'type' => 'success' ,
				'caption' => trans('forms.button.add') ,
				'icon' => 'plus-circle' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>

	<?php /*
|--------------------------------------------------------------------------
| Grid
|--------------------------------------------------------------------------
|
*/ ?>

	<div class="panel panel-default m20">
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
				<tr>
					<td colspan="2"><?php echo e(trans('validation.attributes.title')); ?></td>
					<td><?php echo e(trans('validation.attributes.header_title')); ?></td>
					<td><?php echo e(trans('validation.attributes.slug')); ?></td>
					<td><?php echo e(trans('validation.attributes.template')); ?></td>
					<td><?php echo e(trans('manage.devSettings.categories.trans')); ?></td>
				</tr>
				</thead>
				<tbody>
				<?php foreach($model_data as $model): ?>
					<tr>
						<td>
							<i class="fa fa-<?php echo e($model->icon); ?>"></i>
						</td>
						<td>
							<a href="javascript:void(0)" onclick="masterModal('<?php echo e(url("manage/devSettings/branches/$model->id/edit")); ?>')">
								<?php echo e($model->title()); ?>

							</a>
						</td>
						<td><?php echo e($model->header_title); ?></td>
						<td><?php echo e($model->slug); ?></td>
						<td><?php echo e($model->template); ?></td>
						<td>
							<?php if(!$model->hasFeature('category')): ?>
								<span class="null-content">
									<?php echo e(trans('manage.devSettings.categories.disabled')); ?>

								</span>
							<?php else: ?>
								<a href="<?php echo e(url("manage/devSettings/branches/$model->id")); ?>">
									<?php echo App\Providers\AppServiceProvider::pd(($model->categories()->count())) ?>
									<?php echo e(trans('manage.devSettings.categories.single')); ?>

								</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>