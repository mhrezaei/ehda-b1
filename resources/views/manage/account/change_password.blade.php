@extends('manage.frame.use.0')

@section('section')
	@include('manage.account.tabs')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title">{{$page[1][1] or ''}}</p></div>
	</div>

	{{--
	|--------------------------------------------------------------------------
	| Form
	|--------------------------------------------------------------------------
	|
	--}}

	@include('forms.opener' , [
		'url' => 'manage/account/save/password',
		'class' => 'js mv20' ,
		'no_validation' => 1
	])



		@include('forms.input' , [
		    'name' => 'current_password',
		    'type' => 'password',
		    'class' => 'ltr form-required form-default',
		])

		@include('forms.input' , [
		    'name' => 'new_password',
		    'type' => 'password',
		    'class' => 'ltr form-required form-password',
		])

		@include('forms.input' , [
			'name' => 'password2',
			'type' => 'password',
			'class' => 'ltr form-required',
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