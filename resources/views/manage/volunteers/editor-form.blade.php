@include('forms.opener' , [
	'id' => 'frmEditor',
	'url' => 'manage/volunteers/save/',
	'title' => $page[1][1] ,
	'class' => 'js' ,
])

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]])

	@include('forms.input' , [
		'name' => 'code_melli',
		'value' => $model->code_melli ,
		'class' => 'form-required',
	])

	@include('forms.input' , [
		'name' => 'name_first',
		'value' => $model->name_first ,
		'class' => 'form-required form-default'
	])

	@include('forms.input' , [
	'name' => 'name_last',
	'value' => $model->name_last ,
	'class' => 'form-required ' ,
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
		'name' => 'email',
		'value' => $model->email ,
		'class' => 'form-required ltr',
		'type' => 'email'
	])

	@include('forms.sep')

	@include('forms.select-gender' , [
		'value' => $model->gender,
		'blank_value' => $model->gender? 'NO' : ' ',
		'class' => 'form-required',
	])

	@include('forms.select-marital' , [
		'value' => $model->marital ,
		'blank_value' => $model->marital? 'NO' : ' ',
		'class' => 'form-required',
	])

	@include('forms.select' , [
		'name' => 'birth_city' ,
		'class' => 'form-required',
		'value' => $model->birth_city ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
		'search_placeholder' => trans('forms.button.search') ,
	])

	@include('forms.datepicker' , [
	    'name' => 'birth_date',
	    'value' => $model->birth_date ,
	])

	@include('forms.input' , [
	    'name' => 'tel_mobile',
	    'value' => $model->tel_mobile ,
	    'class' => 'form-required ltr',
	])

	@include('forms.input' , [
	    'name' => 'tel_emergency',
	    'value' => $model->tel_emergency ,
	    'class' => 'form-required ltr',
	])

	@include('forms.sep')

	@include('forms.select-education' , [
		'name' => 'edu_level' ,
	    'value' => $model->edu_level,
		'class' => '' ,
	])

	@include('forms.input' , [
	    'name' => 'edu_field',
	    'value' =>$model->edu_field ,
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
		'value' => $model->home_city ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
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
		'value' => $model->home_postal_code ,
		'class' => 'ltr',
	])

	@include('forms.sep')

	@include('forms.input' , [
	    'name' => 'job',
	    'value' => $model->job ,
	])


	@include('forms.select' , [
		'name' => 'work_city' ,
		'value' => $model->work_city ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
	])

	@include('forms.input' , [
	    'name' => 'work_address',
	    'value' => $model->work_address ,
	])

	@include('forms.input' , [
	    'name' => 'work_tel',
	    'value' => $model->work_tel ,
	    'class' => 'ltr',
	])

	@include('forms.input' , [
	    'name' => 'work_postal_code',
	    'value' =>  $model->work_postal_code,
	    'class' => 'ltr',
	])


	@include('forms.sep')

	@include('forms.select-familization' , [
		'class' => '' ,
		'value' => $model->familization+0 ,
	])

	@include('forms.input' , [
	    'name' => 'motivation',
	    'value' => $model->motivation ,
	])

	@include('forms.input' , [
	    'name' => 'alloc_time',
	    'value' => $model->alloc_time ,
	])

	@include('forms.group-start' , [
		'label' => trans('people.volunteers.manage.exam')
	])

		@include('forms.check' , [
			'name' => '_no_exam',
			'label' => trans('people.volunteers.manage.no_exam'),
			'value' => $model->exam_passed_at? 1 : 0,
		])

	@include('forms.group-end')


	@include('forms.group-start' , [
		'label' => trans('validation.attributes.password')
	])

		@if($model->password)
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

	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('forms.button.save'),
			'shape' => 'success',
			'type' => 'submit' ,
		])

		@include('forms.button' , [
			'label' => trans('forms.button.cancel'),
			'shape' => 'link',
			'link' => '$(".modal").modal("hide")',
		])

	@include('forms.group-end')

	@include('forms.feed' , [])

@include('forms.closer')