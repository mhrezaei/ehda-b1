<?php echo $__env->make('manage.settings.domains-modalEditor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php /*
|--------------------------------------------------------------------------
| Toolbar
|--------------------------------------------------------------------------
|
*/ ?>

<div class="panel panel-toolbar row w100">
	<div class="col-md-4"><p class="title"><?php echo e(trans('manage.devSettings.domains.trans')); ?></p></div>
	<div class="col-md-8 tools">
		<?php echo $__env->make('manage.frame.widgets.toolbar_button' , [
			'target' => 'domainEditor("0")' ,
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
				<td><?php echo e(trans('validation.attributes.title')); ?></td>
				<td><?php echo e(trans('validation.attributes.slug')); ?></td>
				<td><?php echo e(trans('manage.devSettings.domains.admin')); ?></td>
				<td><?php echo e(trans('manage.devSettings.domains.cities')); ?></td>
			</tr>
			</thead>
			<tbody>
			<?php foreach($model_data as $model): ?>
				<tr>
					<td id="domain-<?php echo e($model->id); ?>-title" data-toggle="<?php echo e($model->title); ?>">
						<a href="javascript:void(0)" onclick="domainEditor('<?php echo e($model->id); ?>')">
							<?php echo e($model->title); ?>

						</a>
					</td>
					<td id="domain-<?php echo e($model->id); ?>-slug" data-toggle="<?php echo e($model->slug); ?>" >
						<?php echo e($model->slug); ?>

					</td>
 					<td><?php echo App\Providers\AppServiceProvider::pd(('as123')) ?></td>
					<td>
						<a href="<?php echo e(url('manage/devSettings/domains/'.$model->id)); ?>" >
							<?php echo App\Providers\AppServiceProvider::pd(($model->states()->count().' '.trans('manage.devSettings.domains.city'))) ?>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>