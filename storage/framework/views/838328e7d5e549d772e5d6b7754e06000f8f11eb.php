<select
		id="<?php echo e(isset($id) ? $id : ''); ?>"
		name="<?php echo e($name); ?>" value="<?php echo e(isset($value) ? $value : ''); ?>"
		class="form-control selectpicker <?php echo e(isset($class) ? $class : ''); ?>"
		placeholder="<?php echo e(isset($placeholder) ? $placeholder : ''); ?>"
		data-size= "<?php echo e(isset($size) ? $size : 5); ?>"
		data-live-search = "<?php echo e(isset($search) ? $search : false); ?>"
		data-live-search-placeholder= "<?php echo e(isset($search_placeholder) ? $search_placeholder : trans('forms.button.search')); ?>..."
		onchange="<?php echo e(isset($on_change) ? $on_change : ''); ?>"
		<?php echo e(isset($extra) ? $extra : ''); ?>

>
	<?php if(isset($blank_value) and $blank_value!='NO'): ?>
		<option value="<?php echo e($blank_value); ?>"
				<?php if(!isset($value) or $value==$blank_value): ?>
					selected
				<?php endif; ?>
		><?php echo e(isset($blank_label) ? $blank_label : ''); ?></option>
	<?php endif; ?>
	<?php foreach($options as $option): ?>
		<option value="<?php echo e($option[isset($value_field)? $value_field : 'id']); ?>"
				<?php if(isset($value) and $value==$option[isset($value_field)? $value_field : 'id']): ?>
					selected
				<?php endif; ?>
		><?php echo e($option[isset($caption_field)? $caption_field : 'title']); ?></option>
	<?php endforeach; ?>
</select>

<?php echo $__env->make("forms.js" , [
	'commands' => [
		isset($on_change) ? [$on_change] : [],
	]
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

