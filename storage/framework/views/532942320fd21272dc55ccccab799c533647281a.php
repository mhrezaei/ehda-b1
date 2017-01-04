<?php $__env->startSection('section'); ?>
	<?php echo $__env->make('manage.settings.tabs_dev', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php /*
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	*/ ?>

	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title"><?php echo e($page[2][1]); ?></p></div>
		<div class="col-md-8 tools">

			<?php if($model_data->count()>0): ?>
				<?php echo $__env->make('manage.frame.widgets.toolbar_button' , [
					'target' => "modalForm('modalStateEditor' , '0' , '".$model_data->first()->province()->id."')" ,
					'type' => 'success' ,
					'caption' => trans('forms.button.add') ,
					'icon' => 'plus-circle' ,
				], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php endif; ?>
			<?php echo $__env->make('manage.frame.widgets.toolbar_search' , [
				'target' => url('manage/devSettings/states/search/-key-') ,
				'label' => trans('manage.devSettings.states.city-search') ,
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
					<td><?php echo e(trans('manage.devSettings.domains.city')); ?></td>
					<td><?php echo e(trans('manage.devSettings.states.province-title')); ?></td>
					<td><?php echo e(trans('manage.devSettings.domains.domain')); ?></td>
					<?php /*<td><?php echo e(trans('validation.attributes.capital_id')); ?></td>*/ ?>
				</tr>
				</thead>
				<tbody>
				<?php foreach($model_data as $model): ?>
					<tr>
						<td id="domain-<?php echo e($model->id); ?>-title" data-toggle="<?php echo e($model->title); ?>">
							<a href="javascript:void(0)" onclick="modalForm('modalStateEditor' , '<?php echo e($model->id); ?>')">
								<?php echo e($model->title); ?>

							</a>
						</td>
						<td id="domain-<?php echo e($model->id); ?>-province" data-toggle="<?php echo e($model->province()->id); ?>">
							<?php /*<a href="javascript:void(0)" onclick="modalForm('modalStateEditor' , '<?php echo e($model->province()->id); ?>')">*/ ?>
								<?php echo e($model->province()->title); ?>

							<?php /*</a>*/ ?>
						</td>
						<td>
							<?php echo e($model->domain->title); ?>

						</td>
						<?php /*<td>*/ ?>
							<?php /*<?php if($model->capital()->id == $model->id): ?>*/ ?>
								<?php /*<span class="fa fa-check text-success"></span>*/ ?>
							<?php /*<?php else: ?>*/ ?>
								<?php /*<span>&nbsp;</span>*/ ?>
							<?php /*<?php endif; ?>*/ ?>
						<?php /*</td>*/ ?>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>

	<?php /*
	|--------------------------------------------------------------------------
	| Ajax Called Modal
	|--------------------------------------------------------------------------
	|
	*/ ?>
	<?php echo $__env->make('templates.modal.ajax' , [
		'modal_id' => 'modalStateEditor' ,
		'form_url' => 'manage/devSettings/cities/save',
		'hidden_vars' => [
			url('manage/devSettings/states/-id-/edit/-parent-'),
			trans('manage.devSettings.states.city-edit') ,
			trans('manage.devSettings.states.city-add') ,
		],
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>