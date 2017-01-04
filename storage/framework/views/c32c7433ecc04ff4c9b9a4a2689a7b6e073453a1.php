<?php $__env->startSection('section'); ?>
	<?php echo $__env->make('manage.settings.tabs_dev', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php /*
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	*/ ?>
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title"><?php echo e(trans('manage.devSettings.downstream.trans')); ?></p></div>
		<div class="col-md-8 tools">

			<?php echo $__env->make('manage.frame.widgets.toolbar_button' , [
				'target' => "masterModal('".url('manage/devSettings/downstream/0/edit/')."')" ,
				'type' => 'success' ,
				'caption' => trans('forms.button.add') ,
				'icon' => 'plus-circle' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('manage.frame.widgets.toolbar_search' , [
				'target' => url('manage/devSettings/downstream/search/-key-') ,
				'label' => trans('forms.button.search') ,
				'value' => isset($key)? $key : '' ,
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
					<td><?php echo e(trans('validation.attributes.title')); ?></td>
					<td><?php echo e(trans('validation.attributes.category_id')); ?></td>
					<td><?php echo e(trans('validation.attributes.data_type')); ?></td>
					<td><?php echo e(trans('validation.attributes.value')); ?></td>
					<td><?php echo e(trans('manage.devSettings.domains.trans')); ?></td>
				</tr>
				</thead>
				<tbody>
				<?php foreach($model_data as $key=> $model): ?>
					<tr>
						<td>
							<?php echo App\Providers\AppServiceProvider::pd(($key+1)) ?>
						</td>
						<td>
							<a href="javascript:void(0)" onclick="masterModal('<?php echo e(url("manage/devSettings/downstream/$model->id/edit")); ?>')">
								<?php echo e($model->title); ?>

							</a>
							<i class="mh5 text-grey f10"><?php echo e($model->slug); ?></i>
							<?php if($model->developers_only): ?>
								<i class="fa fa-minus-circle text-danger"></i>
							<?php endif; ?>
						</td>
						<td>
							<?php echo e(trans("manage.devSettings.downstream.category.$model->category")); ?>

						</td>
						<td>
							<?php echo e(trans("manage.devSettings.downstream.data_type.$model->data_type")); ?>

						</td>
						<td>
							<a href="javascript:void(0)" onclick="masterModal('<?php echo e(url("manage/devSettings/downstream/$model->id")); ?>')">
								<?php if($model->global_value): ?>
									<?php if($model->data_type== 'text' or $model->data_type== 'textarea'): ?>
										<?php echo e(str_limit($model->global_value , 100)); ?>

									<?php elseif($model->data_type == 'boolean'): ?>
										<i class="fa fa-check"></i>
									<?php elseif($model->data_type == 'date'): ?>
										<?php echo App\Providers\AppServiceProvider::pd((jdate($model->global_value)->format('Y/m/d'))) ?>
									<?php elseif($model->data_type == 'photo'): ?>
										<i class="fa fa-image"></i>
									<?php endif; ?>
								<?php else: ?>
									<i class="text-grey"><?php echo e(trans('manage.devSettings.downstream.unset')); ?></i>
								<?php endif; ?>
							</a>
						</td>
						<td>
							<?php if($model->available_for_domains): ?>
								<a href="javascript:void(0)" onclick="masterModal('<?php echo e(url("manage/devSettings/downstream/$model->id")); ?>')">

									<?php echo App\Providers\AppServiceProvider::pd((sizeof(json_decode($model->domain_value , true)))) ?>
									<?php echo e(trans('manage.devSettings.domains.domain')); ?>

								</a>
							<?php else: ?>
								<span class="null-content"><?php echo e(trans('posts.manage.global')); ?></span>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="paginate">
		<?php echo $model_data->render(); ?>

	</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('manage.frame.use.0', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>