@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/devSettings/branches/save'),
	'modal_title' => $model_data->id? trans('manage.devSettings.branches.edit.trans') : trans('manage.devSettings.branches.add.trans'),
])
<div class='modal-body'>

	@include('forms.hidden' , [
		'name' => 'id' ,
		'value' => $model_data->id,
	])

	@include('forms.input' , [
	    'name' =>	'plural_title',
	    'value' =>	$model_data->plural_title,
	    'class' => 'form-required form-default' ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
	])
	@include('forms.input' , [
	    'name' =>	'singular_title',
	    'value' =>	$model_data->singular_title,
	    'class' => 'form-required' ,
	    'hint' =>	trans('validation.hint.persian-only'),
	])

	@include('forms.input' , [
	    'name' =>	'slug',
	    'class' =>	'form-required ltr',
		'value' =>	$model_data->slug ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.english-only'),
	])

	@include('forms.input' , [
	    'name' =>	'icon',
	    'class' =>	'form-required ltr',
		'value' =>	$model_data->icon ,
	    'hint' =>	trans('manage.devSettings.branches.icon_hint'),
	])

	@include('forms.input' , [
	    'name' =>	'template',
	    'class' =>	'ltr form-required',
		'value' =>	$model_data->template,
	    'hint' =>	trans('manage.devSettings.branches.template_hint').' '.implode(' , ',$model_data::$available_templates),
	])

	@include('forms.input' , [
		'name' =>	'header_title',
		'value' =>	$model_data->header_title,
		'hint' =>	trans('validation.hint.persian-only'),
	])


	@include('forms.input' , [
	    'name' =>	'features',
	    'label' => trans('manage.devSettings.branches.features'),
	    'class' =>	'ltr',
		'value' =>	$model_data->features ,
	    'hint' =>	trans('manage.devSettings.branches.features_hint').' '.implode(' , ',$model_data::$available_features),
	])


	@include('forms.input' , [
		'name' =>	'allowed_meta',
		'class' =>	'ltr',
		'value' =>	$model_data->allowed_meta ,
		'hint' =>	trans('manage.devSettings.branches.meta_hint').' '.implode(' , ',$model_data::$available_meta_types),
	])

	@if($posts = $model_data->allPosts()->count())
		@include('forms.note' , [
			'shape' => 'warning' ,
			'text' => trans('manage.devSettings.branches.delete_alert_posts' , ['count' => $posts]) ,
			'class' => '-delHandle noDisplay'
		])
	@endif
	@include('forms.note' , [
		'shape' => 'danger' ,
		'text' => trans('manage.devSettings.branches.delete_alert') ,
		'class' => '-delHandle noDisplay'
	])

	@include('forms.group-start')

	@include('forms.button' , [
		'id' => 'btnSave' ,
		'label' => trans('forms.button.save'),
		'shape' => 'success',
		'type' => 'submit' ,
		'value' => 'save' ,
		'class' => '-delHandle'
	])

	@if($model_data->id)
		@include('forms.button' , [
			'id' => 'btnDeleteWarning' ,
			'label' => trans('forms.button.delete'),
			'shape' => 'warning',
			'link' => '$(".-delHandle").toggle()' ,
			'class' => '-delHandle' ,
		])
		@include('forms.button' , [
			'id' => 'btnDelete' ,
			'label' => trans('forms.button.sure_delete'),
			'shape' => 'danger',
			'value' => 'delete' ,
			'type' => 'submit' ,
			'class' => 'noDisplay -delHandle' ,
		])

	@endif


	@include('forms.button' , [
		'label' => trans('forms.button.cancel'),
		'shape' => 'link',
		'link' => '$(".modal").modal("hide")',
	])

	@include('forms.group-end')

	@include('forms.feed')

	@include('forms.closer')

</div>
@include('templates.modal.end')