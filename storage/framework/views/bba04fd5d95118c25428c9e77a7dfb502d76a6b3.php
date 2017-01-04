<?php foreach($fields as $field): ?>
	<input type="hidden" id="<?php echo e(isset($field[2]) ? $field[2] : ''); ?>" name="<?php echo e($field[0]); ?>" value="<?php echo e(isset($field[1]) ? $field[1] : ''); ?>">
<?php endforeach; ?>