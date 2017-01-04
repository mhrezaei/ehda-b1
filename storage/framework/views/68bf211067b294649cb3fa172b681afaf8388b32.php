<?php echo $__env->make('forms.opener' , [
	'id' => 'frmInquiry',
	'url' => 'manage/volunteers/save/inquiry',
	'title' => trans('people.volunteers.manage.create') ,
	'class' => 'js' ,
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
		'id' => 'txtInquiry' ,
		'name' => 'code_melli',
		'value' =>  $model->code_melli ,
		'class' => 'form-required  form-default',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.button' , [
			'label' => trans('forms.button.Inquiry'),
			'shape' => 'primary',
			'type' => 'submit' ,
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.feed' , [], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php echo $__env->make('forms.closer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
