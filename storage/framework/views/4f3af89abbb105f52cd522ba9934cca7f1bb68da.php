<?php echo $__env->make('templates.modal.start' , [
	'partial' => true ,
	'form_url' => 'manage/devSettings/domains/save',
	'modal_title' => $model->id? trans('manage.devSettings.domains.edit') : trans('manage.devSettings.domains.add'),
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class='modal-body'>

	<?php echo $__env->make('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
		'name' =>	'title',
		'value' =>	$model->title ,
		'class' => 'form-required form-default' ,
		'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
		'name' =>	'slug',
		'class' =>	'form-required ltr',
		'value' =>	$model->slug ,
		'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.english-only'),
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('forms.input' , [
		'name' =>	'alias',
		'class' =>	'ltr',
		'value' =>	$model->alias ,
		'hint' =>	trans('manage.devSettings.domains.alias_hint'),
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.note' , [
		'fake' => $city_count = $model->states()->count() ,
		'shape' => $city_count? 'warning' : 'danger' ,
		'text' => $city_count? trans('manage.devSettings.domains.domain_cant_delete_alert' , ['count' => $city_count]) : trans('manage.devSettings.states.city_delete_alert') ,
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

	<?php if($model->id): ?>
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
			'class' => 'noDisplay -delHandle' ,
			'extra' => $city_count? 'disabled' : ''
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php endif; ?>


	<?php echo $__env->make('forms.button' , [
		'label' => trans('forms.button.cancel'),
		'shape' => 'link',
		'link' => '$(".modal").modal("hide")',
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.feed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</div>
<?php echo $__env->make('templates.modal.end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>