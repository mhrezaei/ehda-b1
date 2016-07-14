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
		'value' => isset($model)? $model->gender : '0' ,
		'blank_value' => isset($model)? 'NO' : ' ',
		'class' => 'form-required',
	])

	@include('forms.select-marital' , [
		'value' => isset($model)? $model->marital_status : '0' ,
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

	@include('forms.datepicker' , [
	    'name' => 'birth_date',
	    'value' => isset($model)? $model->birth_date : '',
	])

	@include('forms.input' , [
	    'name' => 'tel_mobile',
	    'value' => isset($model)? $model->tel_mobile : '',
	    'class' => 'form-required ltr',
	])

	@include('forms.input' , [
	    'name' => 'tel_emergency',
	    'value' => isset($model)? $model->tel_emergency : '',
	    'class' => 'form-required ltr',
	])

	@include('forms.sep')

	@include('forms.select-education' , [
		'name' => 'edu_level' ,
		'class' => '' ,
	])
	
	@include('forms.input' , [
	    'name' => 'edu_field',
	    'value' => isset($model)? $model->edu_field : '',
	    'class' => '' ,
	])

	@include('forms.select' , [
		'name' => 'edu_city' ,
		'value' => isset($model)? $model->edu_city : '0' ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
		'search_placeholder' => trans('forms.button.search') ,
	])

	@include('forms.sep')

	@include('forms.select' , [
		'name' => 'home_city' ,
		'value' => isset($model)? $model->home_city : '0' ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
	])

	@include('forms.input' , [
	    'name' => 'home_address',
	    'value' => isset($model)? $model->home_address : '',
	])

	@include('forms.input' , [
	    'name' => 'home_tel',
	    'value' => isset($model)? $model->home_tel : '' ,
	    'class' => 'ltr',
	])

	@include('forms.sep')
	
	@include('forms.input' , [
	    'name' => 'job',
	    'value' => isset($model)? $model->job : '' ,
	])
	

	@include('forms.select' , [
		'name' => 'work_city' ,
		'value' => isset($model)? $model->work_city : '0' ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
	])

	@include('forms.input' , [
	    'name' => 'work_address',
	    'value' => isset($model)? $model->work_address : '',
	])

	@include('forms.input' , [
	    'name' => 'work_tel',
	    'value' => isset($model)? $model->work_tel : '' ,
	    'class' => 'ltr',
	])


	@include('forms.sep')

	@include('forms.select-familization' , [
		'class' => '' ,
		'value' => isset($model)? $model->familization : '0' ,
	])

	@include('forms.input' , [
	    'name' => 'motivation',
	    'value' => isset($model)? $model->motivation : '',
	])

	@include('forms.input' , [
	    'name' => 'alloc_time',
	    'value' => isset($model)? $model->alloc_time : '',
	])

	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('forms.button.save'),
			'shape' => 'success',
			'type' => 'submit' ,
		])

	@include('forms.group-end')

	@include('forms.feed' , [])

	@include('forms.closer')

@endsection
