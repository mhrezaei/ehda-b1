{!! Form::open([
	'url'	=> 'password/auth_password' ,
	'method'=> 'post',
]) !!}

	<div class="header header-success text-center">
		<h4>{{ trans('manage.old_password.head_title') }}</h4>
	</div>

	<div class="alert alert-info">{{ trans('manage.old_password.change_password_msg') }}</div>

	<div class="content">
		@include('manage.old_password.input' , [
			'name' => 'password' ,
			'icon' => 'lock_outline',
			'cap' => trans('validation.attributes.password'),
			'type' => 'password'
		])
		@include('manage.old_password.input' , [
			'name' => 'password2' ,
			'icon' => 'lock_outline',
			'cap' => trans('validation.attributes.password2'),
			'type' => 'password',
		])
	</div>

	<div class="footer text-center">
		<button type="submit" class="btn btn-success btn-wd btn-lg">
			{{ trans('forms.button.save') }}
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
