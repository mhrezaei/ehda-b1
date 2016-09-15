@extends('manage.frame.use.0')

@section('section')
	@include('manage.settings.tabs_dev')

	@include('forms.opener',[
		'url' => 'manage/devSettings/branches/save' ,
		'title' => $model->id? trans('manage.devSettings.branches.edit.trans') : trans('manage.devSettings.branches.add.trans'),
		'class' => 'js' ,
	])

	@include('forms.hidden' , [
		'name' => 'id' ,
		'value' => $model->id,
	])

	@include('forms.input' , [
	    'name' =>	'plural_title',
	    'value' =>	$model->plural_title,
	    'class' => 'form-required form-default' ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
	])
	@include('forms.input' , [
	    'name' =>	'singular_title',
	    'value' =>	$model->singular_title,
	    'class' => 'form-required' ,
	    'hint' =>	trans('validation.hint.persian-only'),
	])

	@include('forms.input' , [
	    'name' =>	'slug',
	    'class' =>	'form-required ltr',
		'value' =>	$model->slug ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.english-only'),
	])

	@include('forms.input' , [
	    'name' =>	'icon',
	    'class' =>	'form-required ltr',
		'value' =>	$model->icon ,
	    'hint' =>	trans('manage.devSettings.branches.icon_hint'),
	])

	@include('forms.input' , [
	    'name' =>	'template',
	    'class' =>	'ltr form-required',
		'value' =>	$model->template,
	    'hint' =>	trans('manage.devSettings.branches.template_hint').' '.implode(' , ',$model::$available_templates),
	])

	@include('forms.input' , [
	    'name' =>	'features',
	    'label' => trans('manage.devSettings.branches.features'),
	    'class' =>	'ltr',
		'value' =>	$model->features ,
	    'hint' =>	trans('manage.devSettings.branches.features_hint').' '.implode(' , ',$model::$available_features),
	])


	@include('forms.input' , [
		'name' =>	'allowed_meta',
		'class' =>	'ltr',
		'value' =>	$model->allowed_meta ,
		'hint' =>	trans('manage.devSettings.branches.meta_hint').' '.implode(' , ',$model::$available_meta_types),
	])

	@include('forms.group-start')

	@include('forms.button' , [
		'label' => trans('forms.button.save'),
		'shape' => 'success',
		'type' => 'submit' ,
	])
	@include('forms.button' , [
		'label' => trans('forms.button.cancel'),
		'shape' => 'link',
		'link' => '/manage/devSettings/branches'
	])

	@include('forms.group-end')

	@include('forms.feed')

	@include('forms.closer')
@endsection
