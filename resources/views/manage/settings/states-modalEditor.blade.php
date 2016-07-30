@include('forms.hidden' , [
	'name' => 'id' ,
	'value' => isset($model)? $model->id : '0' ,
])
@include('forms.hidden' , [
	'name' => 'parent_id' ,
	'value' => '0' ,
])

@include('forms.input' , [
	'name' =>	'title',
	'class' => 'form-required' ,
	'value' => isset($model)? $model->title : '' ,
	'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
])

@include('forms.select' , [
	'name' =>	'capital_id',
	'class' => 'form-required',
	'options' => isset($model)? $model->cities()->orderBy('title')->get()->toArray() : $cities->toArray() ,
	'value' => isset($model)? $model->capital()->id : '0' ,
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