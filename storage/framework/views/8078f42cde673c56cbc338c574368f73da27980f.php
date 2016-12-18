<?php
if(isset($class) && str_contains($class, 'form-required')) {
	$required = true;
}
?>

<div class="form-group">
	<label
			for="<?php echo e($name); ?>"
			class="col-sm-2 control-label <?php echo e(isset($label_class) ? $label_class : ''); ?>"
	>
		<?php echo e(isset($label) ? $label : trans("validation.attributes.$name")); ?>

		<?php if(isset($required) and $required): ?>
			<span class="fa fa-star required-sign " title="<?php echo e(trans('forms.logic.required')); ?>"></span>
		<?php endif; ?>
	</label>

	<div class="col-sm-10">
		<?php echo $__env->make('forms.select_self', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<span class="help-block <?php echo e(isset($hint_class) ? $hint_class : ''); ?>">
			<?php echo e(isset($hint) ? $hint : ''); ?>

		</span>

	</div>
</div>