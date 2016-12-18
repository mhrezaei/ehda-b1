<?php $__env->startSection('section'); ?>
	<?php echo $__env->make('manage.settings.tabs_dev', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php /*
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	*/ ?>
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title"><?php echo e(trans('manage.devSettings.categories.trans')); ?></p></div>
		<div class="col-md-8 tools">

			<?php echo $__env->make('manage.frame.widgets.toolbar_button' , [
				'target' => "masterModal('".url('manage/devSettings/categories/0/edit/'.$branch->id)."')" ,
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
					<td>#</td>
					<td><?php echo e(trans('manage.devSettings.categories.title')); ?></td>
					<td><?php echo e(trans('validation.attributes.slug')); ?></td>
				</tr>
				</thead>
				<tbody>
				<?php foreach($model_data as $key=> $model): ?>
					<tr>
						<td>
							<?php echo App\Providers\AppServiceProvider::pd(($key+1)) ?>
						</td>
						<td>
							<a href="javascript:void(0)" onclick="masterModal('<?php echo e(url("manage/devSettings/categories/$model->id/edit")); ?>')">
								<?php echo e($model->title); ?>

							</a>
						</td>
						<td>
							<?php echo e($model->slug); ?>

						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>