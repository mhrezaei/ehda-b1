@include('forms.opener' , [
	'id' => 'frmEditor',
	'url' => 'manage/cards/save',
	'title' => $model->id? trans('people.cards.manage.edit').' '.$model->fullName() : trans('people.cards.manage.create') ,
	'class' => 'js' ,
	'no_validation' => 1 ,
])

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id],
		['code_melli' , $model->code_melli]
	]])

	@include('forms.input' , [
		'name' => 'code_melli',
		'value' =>  $model->code_melli ,
//		'class' => 'disabled',
		'extra' => 'disabled' , //Auth::user()->isDeveloper()? '' : 'disabled' ,
	])

	@include("forms.select" , [
		'name' => "event_id",
		'value' => $model->event_id,
		'blank_value' => "",
		'blank_label' => " ",
		'options' => $events,
	])


	@include('forms.input' , [
		'name' => 'name_first',
		'value' =>$model->name_first ,
		'class' => 'form-required form-default'
	])

	@include('forms.input' , [
	'name' => 'name_last',
	'value' =>$model->name_last ,
	'class' => 'form-required'
	])

	@include('forms.input' , [
		'name' => 'code_id',
		'value' => $model->code_id ,
		'class' => 'form-required form-number' ,
	])
	@include('forms.input' , [
		'name' => 'name_father',
		'value' => $model->name_father ,
		'class' => 'form-required' ,
	])

	@include('forms.input' , [
		'name' => 'tel_mobile',
		'value' => $model->tel_mobile ,
		'class' => 'ltr form-required',
	])


	@include('forms.input' , [
		'name' => 'email',
		'value' => $model->email ,
		'class' => 'ltr',
		'type' => 'email'
	])

	{{--@if(!$model->id)--}}
	{{--@include('forms.input' , [--}}
	{{--'name' => 'password',--}}
	{{--'value' => rand(10000000 , 99999999),--}}
	{{--'class' => 'form-required ltr'--}}
	{{--])--}}
	{{--@endif--}}

	@include('forms.sep')

	@include('forms.select-gender' , [
		'value' => $model->id? $model->gender : '0' ,
		'blank_value' => $model->id? 'NO' : ' ',
		'class' => 'form-required',
	])

	@include('forms.select-marital' , [
		'blank_value' => ' ',
		'value' => $model->id? $model->marital : '0' ,
		'class' => '',
	])

	@include('forms.select' , [
		'name' => 'birth_city' ,
		'class' => 'form-required',
		'value' => $model->id? $model->birth_city : '0' ,
		'blank_value' => '' ,
		'options' => $states ,
		'search' => true ,
		'search_placeholder' => trans('forms.button.search') ,
	])

	@include('forms.datepicker' , [
		'name' => 'birth_date',
		'class' => 'form-required' ,
		'value' => $model->birth_date ,
	])

	@include('forms.sep')

	@include('forms.select-education' , [
		'name' => 'edu_level' ,
		'class' => 'form-required' ,
		'blank_value' => '' ,
		'value' => $model->edu_level ,
	])

	@include('forms.input' , [
		'name' => 'edu_field',
		'value' => $model->edu_field,
		'class' => '' ,
	])

	@include('forms.select' , [
		'name' => 'edu_city' ,
		'value' =>  $model->edu_city  ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
		'search_placeholder' => trans('forms.button.search') ,
	])

	@include('forms.sep')

	@include('forms.select' , [
		'name' => 'home_city' ,
		'value' => $model->id? $model->home_city : '0' ,
		'blank_value' => '' ,
		'options' => $states ,
		'search' => true ,
		'class' => 'form-required'
	])

	@include('forms.input' , [
		'name' => 'home_address',
		'value' => $model->home_address,
	])

	@include('forms.input' , [
		'name' => 'home_tel',
		'value' => $model->home_tel ,
		'class' => 'ltr',
	])

	@include('forms.input' , [
		'name' => 'home_postal_code',
		'value' => $model->home_postal_code  ,
		'class' => 'ltr',
	])

	@include('forms.input' , [
		'name' => 'job',
		'value' => $model->job  ,
	])


<div class="noDisplay">
	@include('forms.sep')
	@include('forms.group-start' , [
		'required' => true ,
		'label' => trans('validation.attributes.organs'),
		'class' => "noDisplay",
	])
			@include('manage.cards.editor-organs' , [
				'organs' => $model::$donatable_organs ,
			])

		@include('forms.group-end')
	</div>

	@include('forms.sep')

	@include('forms.group-start' , [
		'label' => trans('validation.attributes.newsletter')
	])

		@include('forms.check' , [
			'name' => 'newsletter',
			'value' => $model->newsletter,
			'label' => trans('people.cards.manage.newsletter_membership')
		])

	@include('forms.group-end')

	@include('forms.sep')

	@include('forms.group-start' , [
		'label' => trans('validation.attributes.password')
	])

		@if($model->id)
			@include('forms.check' , [
				'name' => '_password_set_to_mobile',
				'value' => false ,
				'label' => trans('people.cards.manage.password_set_to_mobile') ,
			])
		@else
			<div class="text-danger disabled mv5">
				<i class="fa fa-check-square"></i>
				{{ trans('people.cards.manage.preset_password') }}
			</div>
		@endif


	@include('forms.group-end')

	@include('forms.sep')

	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('forms.button.save'),
			'shape' => 'success',
			'type' => 'submit' ,
		])

		@include('forms.button' , [
			'label' => trans('people.cards.manage.save_and_send_to_print'),
			'value' => 'print' ,
			'shape' => 'primary',
			'type' => 'submit' ,
		])

	@include('forms.group-end')

	@include('forms.feed' , [])

@include('forms.closer')
