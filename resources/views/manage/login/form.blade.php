{!! Form::open([
	'url'	=> 'manage/auth' ,
	'method'=> 'post',
]) !!}

	<div class="header header-success text-center">
		<h4>{{ trans('manage.login-pageTitle') }}</h4>
	</div>

	<div class="content">
		@include('manage.login.input' , [
			'name' => 'username' ,
			'icon' => 'face',
			'cap' => trans('validation.attributes.username')
		])
		@include('manage.login.input' , [
			'name' => 'password' ,
			'icon' => 'lock_outline',
			'cap' => trans('validation.attributes.password'),
			'type' => 'password',
		])
		@include('manage.login.input' , [
			'name' => 'captcha' ,
			'icon' => 'visibility',
			'cap' => trans('validation.attributes.security')
		])
	</div>

	<div class="footer text-center">
		<button type="submit" class="btn btn-success btn-wd btn-lg">
			{{ trans('forms.button.login') }}
		</button>
	</div>


{!! Form::close() !!}
