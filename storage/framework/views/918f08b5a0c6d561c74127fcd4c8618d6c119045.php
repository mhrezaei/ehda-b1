<?php echo $__env->make('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/volunteers/save/publish'),
	'modal_title' => trans('people.commands.publish'),
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class='modal-body'>

	<?php echo $__env->make('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
		'name' => '',
		'label' => trans('validation.attributes.name_first'),
		'value' => $model->fullName() ,
		'extra' => 'disabled' ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('forms.note' , [
			'text' => trans('people.form.will-be-notified') ,
			'shape' => 'info' ,
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


		<?php echo $__env->make('forms.button' , [
			'label' => trans('people.commands.publish'),
			'shape' => 'success',
			'type' => 'submit' ,
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('forms.button' , [
			'label' => trans('forms.button.cancel'),
			'shape' => 'link',
			'link' => '$(".modal").modal("hide")',
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.feed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</div>
<?php echo $__env->make('templates.modal.end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>