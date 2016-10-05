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

]
@include('forms.feed')