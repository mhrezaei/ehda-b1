<?php
if(isset($class) && str_contains($class, 'form-required')) {
	$required = true;
}
?>
<style>
	.dropdown-menu, .filter-option{
		text-align: right !important;
	}
</style>
<div class="form-group">
	<label
			for="<?php echo e($field); ?>"
			class="<?php echo e(isset($label_class) ? $label_class : ''); ?>"
	>
		<?php echo e(isset($label) ? $label : trans("validation.attributes.$field")); ?>

		<?php if(isset($required)): ?>
			<span class="text-danger">*</span>
		<?php endif; ?>
	</label>

		<select
				id="<?php echo e(isset($field) ? $field : ''); ?>"
				name="<?php echo e(isset($field) ? $field : ''); ?>" value="<?php echo e(isset($value) ? $value : ''); ?>"
				class="form-control selectpicker <?php echo e(isset($class) ? $class : ''); ?>"
				placeholder="<?php echo e(isset($placeholder) ? $placeholder : ''); ?>"
				data-size= "<?php echo e(isset($size) ? $size : 5); ?>"
				data-live-search = "<?php echo e(isset($search) ? $search : false); ?>"
				data-live-search-placeholder= "<?php echo e(isset($search_placeholder) ? $search_placeholder : trans('forms.button.search')); ?>..."
				<?php echo e(isset($extra) ? $extra : ''); ?>

				error-value="<?php echo e(trans('validation.javascript_validation.' . $field)); ?>"
				<?php echo e(isset($att) ? $att : ''); ?>

		>
			<?php if(isset($blank_value) and $blank_value!='NO'): ?>
				<option value="<?php echo e($blank_value); ?>"
						<?php if(!isset($value) or $value==$blank_value): ?>
							selected
						<?php endif; ?>
				></option>
			<?php endif; ?>
			<?php foreach($options as $option): ?>
				<option value="<?php echo e($option['id']); ?>"
						<?php if(isset($value) and $value==$option['id']): ?>
							selected
						<?php endif; ?>
				>
					<?php echo e($option['title']); ?></option>
			<?php endforeach; ?>
		</select>
		<span class="help-block">
			<?php echo e(isset($hint) ? $hint : ''); ?>

		</span>

</div>