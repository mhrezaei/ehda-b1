@include('forms.hidden' , [
	'name' => 'id' ,
	'value' => isset($model)? $model->id : '0' ,
])

@include('forms.input' , [
	'name' =>	'title',
	'class' => 'form-required' ,
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

@include('forms.group-start')

	@include('forms.button' , [
		'label' => trans('forms.button.save'),
		'shape' => 'success',
		'type' => 'submit' ,
	])
	@include('forms.button' , [
		'label' => trans('forms.button.cancel'),
		'shape' => 'link',
		'link' => '$(".modal").modal("hide")',
	])

@include('forms.group-end')

@include('forms.feed')
