<?php if(Auth::user()->can("$module.*")): ?>
	<?php echo $__env->make('forms.sep', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('forms.group-start' , [
		'label' => $label,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="row w100 m5">
		<?php foreach($model->availableModules($permits) as $permit): ?>
			<?php if(Auth::user()->can("$module.$permit")): ?>
				<div class="col-md-3">
					<div class="checkbox">
						<label>
							<input type="hidden" name="role_<?php echo e($module); ?>_<?php echo e($permit); ?>" value="0">
							<?php echo Form::checkbox("role_".$module."_".$permit , '1' , $model->can("$module.$permit")? '1' : '0' , ['class' => '-permits']); ?>

							<?php echo e(trans('manage.permits.'.$permit)); ?>

						</label>
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>

	<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
