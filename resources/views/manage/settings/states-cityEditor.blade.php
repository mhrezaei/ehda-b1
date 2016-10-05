@include('forms.hidden' , [
	'name' => 'id' ,
	'value' => isset($model)? $model->id : '0' ,
])

@include('forms.input' , [
	'name' =>	'title',
	'class' => 'form-required form-default' ,
	'value' => isset($model)? $model->title : '' ,
//	'hint' =>	trans('validation.hint.unique'),
])

@include('forms.select' , [
	'name' =>	'province_id',
	'class' => 'form-required',
	'options' => $provinces->toArray(),
	'value' => isset($model)? $model->parent_id : $parent_id ,
	'blank_value' => '0' ,
])

@include('forms.select' , [
	'name' =>	'domain_id',
	'class' => 'form-required',
	'options' => $domains->toArray(),
	'value' => isset($model)? $model->domain_id : $guess_domain ,
	'blank_value' => '0' ,
])

@include('forms.note' , [
	'shape' => 'danger' ,
	'text' => trans('manage.devSettings.states.city_delete_alert') ,
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

	@if(isset($model))
		@include('forms.button' , [
			'id' => 'btnDeleteWarning' ,
			'label' => trans('forms.button.delete'),
			'shape' => 'warning',
			'link' => '$(".-delHandle").toggle()' ,
			'class' => '-delHandle' ,
		])
		@include('forms.button' , [
			'id' => 'btnDelete' ,
			'label' => trans('forms.button.sure_hard_delete'),
			'shape' => 'danger',
			'value' => 'delete' ,
			'type' => 'submit' ,
			'class' => 'noDisplay -delHandle'
		])

	@endif


	@include('forms.button' , [
		'label' => trans('forms.button.cancel'),
		'shape' => 'link',
		'link' => '$(".modal").modal("hide")',
	])

@include('forms.group-end')

@include('forms.feed')
