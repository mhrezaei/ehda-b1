<?php echo $__env->make('forms.hidden' , [
	'name' => 'id' ,
	'value' => isset($model)? $model->id : '0' ,
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('forms.input' , [
	'name' =>	'title',
	'class' => 'form-required form-default' ,
	'value' => isset($model)? $model->title : '' ,
//	'hint' =>	trans('validation.hint.unique'),
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('forms.select' , [
	'name' =>	'province_id',
	'class' => 'form-required',
	'options' => $provinces->toArray(),
	'value' => isset($model)? $model->parent_id : $parent_id ,
	'blank_value' => '0' ,
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('forms.select' , [
	'name' =>	'domain_id',
	'class' => 'form-required',
	'options' => $domains->toArray(),
	'value' => isset($model)? $model->domain_id : $guess_domain ,
	'blank_value' => '0' ,
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('forms.note' , [
	'shape' => 'danger' ,
	'text' => trans('manage.devSettings.states.city_delete_alert') ,
	'class' => '-delHandle noDisplay'
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('forms.group-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.button' , [
		'id' => 'btnSave' ,
		'label' => trans('forms.button.save'),
		'shape' => 'success',
		'type' => 'submit' ,
		'value' => 'save' ,
		'class' => '-delHandle'
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php if(isset($model)): ?>
		<?php echo $__env->make('forms.button' , [
			'id' => 'btnDeleteWarning' ,
			'label' => trans('forms.button.delete'),
			'shape' => 'warning',
			'link' => '$(".-delHandle").toggle()' ,
			'class' => '-delHandle' ,
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('forms.button' , [
			'id' => 'btnDelete' ,
			'label' => trans('forms.button.sure_hard_delete'),
			'shape' => 'danger',
			'value' => 'delete' ,
			'type' => 'submit' ,
			'class' => 'noDisplay -delHandle'
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php endif; ?>


	<?php echo $__env->make('forms.button' , [
		'label' => trans('forms.button.cancel'),
		'shape' => 'link',
		'link' => '$(".modal").modal("hide")',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('forms.feed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
