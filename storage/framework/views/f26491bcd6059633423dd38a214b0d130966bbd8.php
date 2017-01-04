<?php echo $__env->make('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/cards/save/bulk_print'),
	'modal_title' => trans('forms.button.card_print'),
	'no-validation' => '1' ,
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class='modal-body'>

	<?php echo $__env->make('forms.hiddens' , ['fields' => [
		['ids' , '' ],
	]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
		'name' => '',
		'id' => 'txtCount' ,
		'label' => trans('validation.attributes.items'),
		'extra' => 'disabled' ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.select' , [
		'name' => 'status' ,
		'value' =>  ''  ,
		'blank_value' => '' ,
		'options' => $print ,
		'value_field' => '0' ,
		'caption_field' => '1' ,
		'size' => 10 ,
		'class' => 'form-required',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo $__env->make('forms.button' , [
			'label' => trans('forms.button.save'),
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
<script>gridSelector('get')</script>