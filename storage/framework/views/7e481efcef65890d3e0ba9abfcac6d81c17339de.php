<?php echo $__env->make('templates.modal.start' , [
	'modal_id' => $modal_id ,
	'modal_size' => isset($modal_size)? $modal_size : 'lg',
	'form_url' => isset($form_url)? $form_url : 'javascript:void(0)',
	'modal_title' => isset($modal_title)? $modal_title : '',
	'hidden_vars' => isset($hidden_vars)? $hidden_vars : '',
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class='modal-body'>...</div>
<?php echo $__env->make('templates.modal.end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>