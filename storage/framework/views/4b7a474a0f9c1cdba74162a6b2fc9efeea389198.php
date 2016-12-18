<?php echo $__env->make('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/devSettings/branches/save'),
	'modal_title' => $model_data->id? trans('manage.devSettings.branches.edit.trans') : trans('manage.devSettings.branches.add.trans'),
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class='modal-body'>

	<?php echo $__env->make('forms.hidden' , [
		'name' => 'id' ,
		'value' => $model_data->id,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' =>	'plural_title',
	    'value' =>	$model_data->plural_title,
	    'class' => 'form-required form-default' ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('forms.input' , [
	    'name' =>	'singular_title',
	    'value' =>	$model_data->singular_title,
	    'class' => 'form-required' ,
	    'hint' =>	trans('validation.hint.persian-only'),
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' =>	'slug',
	    'class' =>	'form-required ltr',
		'value' =>	$model_data->slug ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.english-only'),
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' =>	'icon',
	    'class' =>	'form-required ltr',
		'value' =>	$model_data->icon ,
	    'hint' =>	trans('manage.devSettings.branches.icon_hint'),
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
	    'name' =>	'template',
	    'class' =>	'ltr form-required',
		'value' =>	$model_data->template,
	    'hint' =>	trans('manage.devSettings.branches.template_hint').' '.implode(' , ',$model_data::$available_templates),
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.input' , [
		'name' =>	'header_title',
		'value' =>	$model_data->header_title,
		'hint' =>	trans('validation.hint.persian-only'),
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


	<?php echo $__env->make('forms.input' , [
	    'name' =>	'features',
	    'label' => trans('manage.devSettings.branches.features'),
	    'class' =>	'ltr',
		'value' =>	$model_data->features ,
	    'hint' =>	trans('manage.devSettings.branches.features_hint').' '.implode(' , ',$model_data::$available_features),
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


	<?php echo $__env->make('forms.input' , [
		'name' =>	'allowed_meta',
		'class' =>	'ltr',
		'value' =>	$model_data->allowed_meta ,
		'hint' =>	trans('manage.devSettings.branches.meta_hint').' '.implode(' , ',$model_data::$available_meta_types),
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php if($posts = $model_data->allPosts()->count()): ?>
		<?php echo $__env->make('forms.note' , [
			'shape' => 'warning' ,
			'text' => trans('manage.devSettings.branches.delete_alert_posts' , ['count' => $posts]) ,
			'class' => '-delHandle noDisplay'
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
	<?php echo $__env->make('forms.note' , [
		'shape' => 'danger' ,
		'text' => trans('manage.devSettings.branches.delete_alert') ,
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

		<?php if($model_data->id): ?>
			<?php echo $__env->make('forms.button' , [
				'id' => 'btnDeleteWarning' ,
				'label' => trans('forms.button.delete'),
				'shape' => 'warning',
				'link' => '$(".-delHandle").toggle()' ,
				'class' => '-delHandle' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('forms.button' , [
				'id' => 'btnDelete' ,
				'label' => trans('forms.button.sure_delete'),
				'shape' => 'danger',
				'value' => 'delete' ,
				'type' => 'submit' ,
				'class' => 'noDisplay -delHandle' ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php endif; ?>


		<?php echo $__env->make('forms.button' , [
			'label' => trans('forms.button.cancel'),
			'shape' => 'link',
			'link' => '$(".modal").modal("hide")',
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.feed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('forms.closer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</div>
<?php echo $__env->make('templates.modal.end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>