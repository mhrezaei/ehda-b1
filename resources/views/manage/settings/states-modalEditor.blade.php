@include('forms.hiddens' , ['fields' => [
	['id' , isset($model)? $model->id : '0'],
	['parent_id' , '0']
]])

@include('forms.input' , [
	'name' =>	'title',
	'class' => 'form-required form-default' ,
	'value' => isset($model)? $model->title : '' ,
	'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
])

@include('forms.select' , [
	'name' =>	'capital_id',
//	'class' => 'form-required',
	'options' => isset($model)? $model->cities()->orderBy('title')->get()->toArray() : $cities->get()->toArray() ,
	'value' => isset($model)? $model->capital()->id : '0' ,
	'blank_value' => '0' ,
	'search' => true ,
])

@if(isset($model))
	@include('forms.note' , [
		'fake' => $city_count = $model->cities()->count() ,
		'shape' => $city_count? 'warning' : 'danger' ,
		'text' => $city_count? trans('manage.devSettings.states.province_cant_delete_alert' , ['count' => $city_count]) : trans('manage.devSettings.states.city_delete_alert') ,
		'class' => '-delHandle noDisplay'
	])
@endif


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
			'class' => 'noDisplay -delHandle' ,
			'extra' => $city_count? 'disabled' : ''
		])

	@endif


	@include('forms.button' , [
		'label' => trans('forms.button.cancel'),
		'shape' => 'link',
		'link' => '$(".modal").modal("hide")',
	])

@include('forms.group-end')

@include('forms.feed')