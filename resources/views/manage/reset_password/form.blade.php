	<div class="header header-success text-center">
		<h4>{{ trans('manage.reset_password.head_title') }}</h4>
	</div>

	<div class="firstForm">
		{!! Form::open([
				'url'	=> 'password/reset_password_process' ,
				'method'=> 'post',
				'class' => 'js',
				'id' => 'reset_password_form'
			]) !!}
		<div class="content">
			@include('manage.reset_password.input' , [
			'name' => 'username' ,
			'icon' => 'face',
			'cap' => trans('validation.attributes.username'),
			'class' => 'form-required form-number',
		])

			@include('manage.reset_password.input' , [
                'name' => 'security' ,
                'icon' => 'visibility',
                'cap' => $captcha['question'],
                'class' => 'form-required form-number',
            ])

			<input type="hidden" name="key" value="{{$captcha['key']}}">
		</div>

		<div class="footer text-center">
			<button type="submit" class="btn btn-success btn-wd btn-lg">
				{{ trans('forms.button.recovery') }}
			</button>
		</div>
		@include('forms.feed')
		{!! Form::close() !!}
	</div>

	<div class="secondForm" style="display: none;">
		{!! Form::open([
				'url'	=> 'password/reset_password_token_process' ,
				'method'=> 'post',
				'class' => 'js',
				'id' => 'reset_password_form_token'
			]) !!}
		<div class="content">
			<input type="hidden" name="national">
			@include('manage.reset_password.input' , [
			'name' => 'token' ,
			'icon' => 'visibility',
			'cap' => trans('validation.attributes.token'),
			'class' => 'form-required form-number'
		])
		</div>

		<div class="footer text-center">
			<button type="submit" class="btn btn-success btn-wd btn-lg">
				{{ trans('forms.button.recovery') }}
			</button>
		</div>
		@include('forms.feed')
		{!! Form::close() !!}
	</div>


