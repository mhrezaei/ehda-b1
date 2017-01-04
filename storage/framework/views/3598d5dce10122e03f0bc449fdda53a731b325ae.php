<?php foreach($model->branch()->allowedMeta() as $field): ?>
	<?php if($field['type']=='textarea'): ?>
		<?php echo $__env->make('forms.textarea' , [
			'name' => $field['name'],
			'value' => $model->meta($field['name']) ,
			'rows' => 3,
			'class' => $field['required']? 'form-required' : ''
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php elseif($field['type']=='date'): ?>
		<?php echo $__env->make('forms.datepicker' , [
			'name' => $field['name'],
			'value' => $model->meta($field['name']),
			'type' => '' ,
			'class' => $field['required']? 'form-required' : ''
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php else: ?>
		<?php echo $__env->make('forms.input' , [
			'name' => $field['name'],
			'value' => $model->meta($field['name']),
			'class' => $field['required']? 'form-required' : ''
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php endif; ?>
<?php endforeach; ?>
