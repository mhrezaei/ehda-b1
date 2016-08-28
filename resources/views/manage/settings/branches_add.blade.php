@extends('manage.frame.use.0')

@section('section')
	@include('manage.settings.dev_tab')

	@include('forms.opener',[
		'url' => 'manage/devSettings/branches/save' ,
		'title' => isset($model)? trans('manage.devSettings.branches.edit.trans') : trans('manage.devSettings.branches.add.trans'),
		'class' => 'js' ,
	])

	@include('forms.hidden' , [
		'name' => 'id' ,
		'value' => isset($model)? $model->id : '0',
	])

	@include('forms.input' , [
	    'name' =>	'plural_title',
	    'value' =>	isset($model)? $model->title() : '',
	    'class' => 'form-required form-default' ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
	])
	@include('forms.input' , [
	    'name' =>	'singular_title',
	    'value' =>	isset($model)? $model->title(true) : '',
	    'class' => 'form-required' ,
	    'hint' =>	trans('validation.hint.persian-only'),
	])

	@include('forms.input' , [
	    'name' =>	'slug',
	    'class' =>	'form-required ltr',
		'value' =>	isset($model)? $model->slug : '',
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.english-only'),
	])

	@include('forms.input' , [
		'name' =>	'allowed_meta',
		'class' =>	'ltr',
		'value' =>	isset($model)? $model->allowed_meta : '',
		'hint' =>	trans('validation.hint.metaـexample'),
	])

	@include('forms.group-start')

	@include('forms.check' , [
	    'name' => 'have_rss',
	    'label' => trans('manage.devSettings.branches.add.have_rss'),
	    'value' => isset($model)? $model->have_rss : '',
	])

	@include('forms.check' , [
	    'name' => 'have_comments',
	    'label' => trans('manage.devSettings.branches.add.have_comments'),
	    'value' => isset($model)? $model->have_comments : '',
	])

	@include('forms.check' , [
	    'name' => 'is_gallery',
	    'label' => trans('manage.devSettings.branches.add.is_gallery'),
	    'value' => isset($model)? $model->is_gallery : '',
	])

	@include('forms.check' , [
	    'name' => 'is_hidden',
	    'label' => trans('manage.devSettings.branches.add.is_hidden'),
	    'value' => isset($model)? $model->is_hidden : '',
	])
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
		'link' => '/manage/devSettings/branches'
	])

	@include('forms.group-end')

	@include('forms.feed')

	@include('forms.closer')
@endsection
