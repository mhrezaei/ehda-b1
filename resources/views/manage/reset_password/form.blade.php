{!! Form::open([
	'url'	=> 'manage/reset_password_process' ,
	'method'=> 'post',
	'class' => 'js',
]) !!}

	<div class="header header-success text-center">
		<h4>{{ trans('manage.reset_password.head_title') }}</h4>
	</div>

	<div class="content">
		@include('manage.reset_password.input' , [
			'name' => 'username' ,
			'icon' => 'face',
			'cap' => trans('validation.attributes.username')
		])

		@include('manage.login.input' , [
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

@if($errors->all())
	<div class="alert alert-danger">
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</div>
@endif

{!! Form::close() !!}
