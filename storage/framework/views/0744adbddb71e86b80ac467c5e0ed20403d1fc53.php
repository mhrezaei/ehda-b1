<?php echo $__env->make('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/cards/save/print'),
	'modal_title' => trans('forms.button.card_print'),
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class='modal-body'>

	<?php echo $__env->make('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php /*	<?php echo $__env->make('forms.input' , [*/ ?>
		<?php /*'name' => '',*/ ?>
		<?php /*'label' => trans('validation.attributes.name_first'),*/ ?>
		<?php /*'value' => $model->fullName() ,*/ ?>
		<?php /*'extra' => 'disabled' ,*/ ?>
	<?php /*], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>

	<?php echo $__env->make('forms.select' , [
		'name' => 'status' ,
		'value' =>  $model->card_print_status  ,
		'blank_value' => '' ,
		'options' => $opt['print'] ,
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

<div class="text-center mv20">
	<a href="<?php echo e(url('/card/show_card/full/'.$model->say('encrypted_code_melli'))); ?>" target="_blank">
		<img src="<?php echo e(url('/card/show_card/mini/'.$model->say('encrypted_code_melli'))); ?>" style="height: 350px">
	</a>
</div>


<?php echo $__env->make('templates.modal.end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>