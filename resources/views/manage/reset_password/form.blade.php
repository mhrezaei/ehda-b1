{!! Form::open([
	'url'	=> 'manage/reset_password_process' ,
	'method'=> 'post',
	'class' => 'js',
	'id' => 'reset_password_form'
]) !!}

	<div class="header header-success text-center">
		<h4>{{ trans('manage.reset_password.head_title') }}</h4>
	</div>

	<div class="content">
		@include('manage.reset_password.input' , [
			'name' => 'username' ,
			'icon' => 'face',
			'cap' => trans('validation.attributes.username'),
			'class' => 'form-required form-number'
		])

		@include('manage.reset_password.input' , [
			'name' => 'security' ,
			'icon' => 'visibility',
			'cap' => $captcha['question']
		])

		<input type="hidden" name="key" value="{{$captcha['key']}}">
		
	</div>

	<div class="footer text-center">
		<button type="submit" class="btn btn-success btn-wd btn-lg">
			{{ trans('forms.button.recovery') }}
		</button>
	</div>

@include('forms.feed')

@if($errors->all())
	<div class="alert alert-danger">
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</div>
@endif

{!! Form::close() !!}
