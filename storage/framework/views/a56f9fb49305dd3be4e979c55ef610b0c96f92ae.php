<?php $__env->startSection('section'); ?>
	<?php echo $__env->make('manage.settings.tabs_dev', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php /*
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	*/ ?>
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title"><?php echo e(trans('manage.devSettings.states.trans')); ?></p></div>
		<div class="col-md-8 tools">

			<?php echo $__env->make('manage.frame.widgets.toolbar_button' , [
				'target' => 'modalForm("modalStateEditor" , "0")' ,
				'type' => 'success' ,
				'caption' => trans('forms.button.add') ,
				'icon' => 'plus-circle' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
					<td><?php echo e(trans('manage.devSettings.states.province-title')); ?></td>
					<td><?php echo e(trans('validation.attributes.capital_id')); ?></td>
					<td><?php echo e(trans('manage.devSettings.domains.cities')); ?></td>
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
						<td id="domain-<?php echo e($model->id); ?>-capital" data-toggle="<?php echo e($model->capital()->title); ?>" >
							<?php echo e($model->capital()->title); ?>

						</td>
						<td>
							<a href="<?php echo e(url('manage/devSettings/states/'.$model->id)); ?>" >
								<?php echo App\Providers\AppServiceProvider::pd(($model->cities()->count().' '.trans('manage.devSettings.domains.city'))) ?>
							</a>
						</td>
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
		'form_url' => 'manage/devSettings/states/save',
		'hidden_vars' => [
			url('manage/devSettings/states/-id-/edit'),
			trans('manage.devSettings.states.province-edit') ,
			trans('manage.devSettings.states.province-add') ,
		],
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>