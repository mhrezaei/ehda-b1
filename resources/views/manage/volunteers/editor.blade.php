@extends('manage.frame.use.0')

@section('section')

	@include('forms.opener',[
		'url' => 'manage/volunteers/save' ,
		'title' => $page[1][1],
		'class' => 'js' ,
	])

	@include('forms.hiddens' , ['fields' => [
		['id' , isset($model)? $model->id : '0'],
	]])

	@include('forms.input' , [
		'name' => 'name_first',
		'value' => isset($model)? $model->name_first : '',
		'class' => 'form-required'
	])
	@include('forms.input' , [
		'name' => 'name_last',
		'value' => isset($model)? $model->name_last : '',
		'class' => 'form-required'
	])

	@include('forms.input' , [
		'name' => 'code_meli',
		'value' => isset($model)? $model->code_meli : '',
		'class' => 'form-required',
	])
	@include('forms.input' , [
		'name' => 'email',
		'value' => isset($model)? $model->email : '',
		'class' => 'form-required ltr',
		'type' => 'email'
	])

	@if(!isset($model))
		@include('forms.input' , [
			'name' => 'password',
			'value' => $random_password,
			'class' => 'form-required ltr'
		])
	@endif

	@include('forms.sep')

	@include('forms.select-gender' , [
		'value' => isset($model)? $model->gender : '' ,
		'blank_value' => isset($model)? 'NO' : ' ',
		'class' => 'form-required',
	])

	@include('forms.select' , [
		'name' => 'birth_city' ,
		'class' => 'form-required',
		'value' => isset($model)? $model->birth_city : '0' ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
		'search_placeholder' => trans('forms.button.search') ,
	])


	@include('forms.feed')

	@include('forms.closer')

@endsection