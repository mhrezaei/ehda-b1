{!! Form::open([
	'url'	=> 'manage/auth' ,
	'method'=> 'post',
]) !!}

	<div class="header header-success text-center">
		<h4>{{ trans('manage.login.head_title') }}</h4>
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
			'name' => 'security' ,
			'icon' => 'visibility',
			'cap' => $captcha['question']
		])

		<input type="hidden" name="key" value="{{$captcha['key']}}">
		
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
