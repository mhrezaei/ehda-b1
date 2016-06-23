{!! Form::open([
	'url'	=> 'manage/auth' ,
	'method'=> 'post',
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
		@include('manage.reset_password.input' , [
			'name' => 'password' ,
			'icon' => 'lock_outline',
			'cap' => trans('validation.attributes.password'),
			'type' => 'password',
		])
		
	</div>

	<div class="footer text-center">
		<button type="submit" class="btn btn-success btn-wd btn-lg">
			{{ trans('forms.button.login') }}
		</button>
		<div style="clear: both;"></div>
		<a href="{{ url('/manage/reset_password') }}" class="btn btn-link reset_password_link">{{ trans('manage.login.reset_password_link') }}</a>
	</div>

@if($errors->all())
	<div class="alert alert-danger">
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</div>
@endif

{!! Form::close() !!}
