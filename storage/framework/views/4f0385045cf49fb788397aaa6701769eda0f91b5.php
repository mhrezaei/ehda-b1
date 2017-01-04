<?php echo $__env->make('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/volunteers/save/permits'),
	'modal_title' => trans('people.commands.view_card'),
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class='modal-body text-center'>
	<a href="<?php echo e(url('/card/show_card/mini/'.$model->say('encrypted_code_melli'))); ?>" target="_blank">
		<img src="<?php echo e(url('/card/show_card/mini/'.$model->say('encrypted_code_melli'))); ?>" style="height: 500px">
	</a>
</div>

<?php echo $__env->make('templates.modal.end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
