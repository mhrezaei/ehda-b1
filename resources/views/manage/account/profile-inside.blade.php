{{-- Inputs ... --}}

@include('forms.input' , [
	'name' => '_name',
	'label' => trans('validation.attributes.code_melli'),
	'value' => $model->code_melli ,
	'extra' => 'disabled' ,
])

@if($show_unchanged or isset($model->changes->name_first))
	@include('forms.input' , [
		'name' => 'name_first',
		'value' => $model->name_first ,
		'class' => 'form-required form-default'
	])
@endif

@if($show_unchanged or isset($model->changes->name_last))
	@include('forms.input' , [
	'name' => 'name_last',
	'value' => $model->name_last ,
	'class' => 'form-required ' ,
	])
@endif


@if($show_unchanged or isset($model->changes->code_id))
	@include('forms.input' , [
		'name' => 'code_id',
		'value' => $model->code_id ,
		'class' => 'form-required form-number' ,
	])
@endif



@if($show_unchanged or isset($model->changes->name_father))
	@include('forms.input' , [
		'name' => 'name_father',
		'value' => $model->name_father ,
		'class' => 'form-required' ,
	])
@endif

@if($show_unchanged or isset($model->changes->gender))
	@include('forms.select-gender' , [
		'value' => $model->gender,
		'blank_value' => $model->gender? 'NO' : ' ',
		'class' => 'form-required',
	])
@endif

@if($show_unchanged or isset($model->changes->marital))
	@include('forms.select-marital' , [
		'value' => isset($model->changes->marital)? $model->changes->marital : $model->marital ,
		'class' => 'form-required',
		'hint' => isset($model->changes->marital)? trans('manage.account.in_profile' , ['v'=>$model->say('marital') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif

@if($show_unchanged or isset($model->changes->email))
	@include('forms.input' , [
		'name' => 'email',
		'class' => 'form-required ltr',
		'type' => 'email' ,
		'value' => isset($model->changes->email)? $model->changes->email : $model->email ,
		'hint' => isset($model->changes->email)? trans('manage.account.in_profile' , ['v'=>$model->say('email') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif


@if($show_unchanged or isset($model->changes->tel_mobile))
	@include('forms.input' , [
		'name' => 'tel_mobile',
		'class' => 'form-required ltr',
		'value' => isset($model->changes->tel_mobile)? $model->changes->tel_mobile : $model->tel_mobile ,
		'hint' => isset($model->changes->tel_mobile)? trans('manage.account.in_profile' , ['v'=>$model->say('tel_mobile') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif

@if($show_unchanged or isset($model->changes->tel_emergency))
	@include('forms.input' , [
		'name' => 'tel_emergency',
		'class' => 'form-required ltr',
		'value' => isset($model->changes->tel_emergency)? $model->changes->tel_emergency : $model->tel_emergency ,
		'hint' => isset($model->changes->tel_emergency)? trans('manage.account.in_profile' , ['v'=>$model->say('tel_emergency') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif

@if($show_unchanged)
	@include('forms.sep')
@endif

@if($show_unchanged or isset($model->changes->edu_level))
	@include('forms.select-education' , [
		'name' => 'edu_level' ,
		'value' => isset($model->changes->edu_level)? $model->changes->edu_level : $model->edu_level ,
		'hint' => isset($model->changes->edu_level)? trans('manage.account.in_profile' , ['v'=>$model->say('edu_level') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif

@if($show_unchanged or isset($model->changes->edu_field))
	@include('forms.input' , [
		'name' => 'edu_field',
		'value' => isset($model->changes->edu_field)? $model->changes->edu_field : $model->edu_field ,
		'hint' => isset($model->changes->edu_field)? trans('manage.account.in_profile' , ['v'=>$model->say('edu_field') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif

@if($show_unchanged or isset($model->changes->edu_city))
	@include('forms.select' , [
		'name' => 'edu_city' ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
		'search_placeholder' => trans('forms.button.search') ,
		'value' => isset($model->changes->edu_city)? $model->changes->edu_city : $model->edu_city ,
		'hint' => isset($model->changes->edu_city)? trans('manage.account.in_profile' , ['v'=>$model->say('edu_city') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif

@if($show_unchanged)
	@include('forms.sep')
@endif

@if($show_unchanged or isset($model->changes->home_city))
	@include('forms.select' , [
		'name' => 'home_city' ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
		'value' => isset($model->changes->home_city)? $model->changes->home_city : $model->home_city ,
		'hint' => isset($model->changes->home_city)? trans('manage.account.in_profile' , ['v'=>$model->say('home_city') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif

@if($show_unchanged or isset($model->changes->home_address))
	@include('forms.input' , [
		'name' => 'home_address',
		'value' => isset($model->changes->home_address)? $model->changes->home_address : $model->home_address ,
		'hint' => isset($model->changes->home_address)? trans('manage.account.in_profile' , ['v'=>$model->say('home_address') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif

@if($show_unchanged or isset($model->changes->home_tel))
	@include('forms.input' , [
		'name' => 'home_tel',
		'class' => 'ltr',
		'value' => isset($model->changes->home_tel)? $model->changes->home_tel : $model->home_tel ,
		'hint' => isset($model->changes->home_tel)? trans('manage.account.in_profile' , ['v'=>$model->say('home_tel') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif

@if($show_unchanged or isset($model->changes->home_postal_code))
	@include('forms.input' , [
		'name' => 'home_postal_code',
		'class' => 'ltr',
		'value' => isset($model->changes->home_postal_code)? $model->changes->home_postal_code : $model->home_postal_code ,
		'hint' => isset($model->changes->home_postal_code)? trans('manage.account.in_profile' , ['v'=>$model->say('home_postal_code') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif

@if($show_unchanged)
	@include('forms.sep')
@endif

@if($show_unchanged or isset($model->changes->job))
	@include('forms.input' , [
		'name' => 'job',
		'value' => isset($model->changes->job)? $model->changes->job : $model->job ,
		'hint' => isset($model->changes->job)? trans('manage.account.in_profile' , ['v'=>$model->say('job') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif


@if($show_unchanged or isset($model->changes->work_city))
	@include('forms.select' , [
		'name' => 'work_city' ,
		'blank_value' => '0' ,
		'options' => $states ,
		'search' => true ,
		'value' => isset($model->changes->work_city)? $model->changes->work_city : $model->work_city ,
		'hint' => isset($model->changes->work_city)? trans('manage.account.in_profile' , ['v'=>$model->say('work_city') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif

@if($show_unchanged or isset($model->changes->work_address))
	@include('forms.input' , [
		'name' => 'work_address',
		'value' => isset($model->changes->work_address)? $model->changes->work_address : $model->work_address ,
		'hint' => isset($model->changes->work_address)? trans('manage.account.in_profile' , ['v'=>$model->say('work_address') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif

@if($show_unchanged or isset($model->changes->work_tel))
	@include('forms.input' , [
		'name' => 'work_tel',
		'class' => 'ltr',
		'value' => isset($model->changes->work_tel)? $model->changes->work_tel : $model->work_tel ,
		'hint' => isset($model->changes->work_tel)? trans('manage.account.in_profile' , ['v'=>$model->say('work_tel') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif

@if($show_unchanged or isset($model->changes->work_postal_code))
	@include('forms.input' , [
		'name' => 'work_postal_code',
		'class' => 'ltr',
		'value' => isset($model->changes->work_postal_code)? $model->changes->work_postal_code : $model->work_postal_code ,
		'hint' => isset($model->changes->work_postal_code)? trans('manage.account.in_profile' , ['v'=>$model->say('work_postal_code') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])

@endif

@if($show_unchanged)
	@include('forms.sep')
@endif

@if($show_unchanged or isset($model->changes->familization))
	@include('forms.select-familization' , [
		'class' => '' ,
		'value' => isset($model->changes->familization)? $model->changes->familization : $model->familization ,
		'hint' => isset($model->changes->familization)? trans('manage.account.in_profile' , ['v'=>$model->say('familization') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif

@if($show_unchanged or isset($model->changes->motivation))
	@include('forms.input' , [
		'name' => 'motivation',
		'value' => isset($model->changes->motivation)? $model->changes->motivation : $model->motivation ,
		'hint' => isset($model->changes->motivation)? trans('manage.account.in_profile' , ['v'=>$model->say('motivation') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif

@if($show_unchanged or isset($model->changes->alloc_time))
	@include('forms.input' , [
		'name' => 'alloc_time',
		'value' => isset($model->changes->alloc_time)? $model->changes->alloc_time : $model->alloc_time ,
		'hint' => isset($model->changes->alloc_time)? trans('manage.account.in_profile' , ['v'=>$model->say('alloc_time') ]) : '' ,
		'hint_class' => 'help-flag' ,
	])
@endif
