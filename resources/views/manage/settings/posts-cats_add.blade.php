@extends('manage.frame.use.0')

@section('section')
	@include('manage.settings.dev_tab')

	@include('forms.opener',[
		'url' => 'manage/devSettings/posts-cats/save' ,
		'title' => isset($model)? trans('manage.devSettings.posts-cats.edit.trans') : trans('manage.devSettings.posts-cats.add.trans'),
		'class' => 'js' ,
	])

	@include('forms.hidden' , [
		'name' => 'id' ,
		'value' => isset($model)? $model->id : '0',
	])
	@include('forms.hidden' , [
		'name' => 'parent_id' ,
		'value' => isset($model)? $model->parent_id : '0',
	])

	@include('forms.input' , [
	    'name' =>	'title',
	    'value' =>	isset($model)? $model->title : '',
	    'class' => 'form-required' ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
	])

	@include('forms.input' , [
	    'name' =>	'slug',
	    'class' =>	'form-required ltr',
		'value' =>	isset($model)? $model->slug : '',
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.english-only'),
	])

	@include('forms.group-start')

	@include('forms.check' , [
	    'name' => 'have_rss',
	    'label' => trans('manage.devSettings.posts-cats.add.have_rss'),
	    'value' => isset($model)? $model->have_rss : '',
	])

	@include('forms.check' , [
	    'name' => 'have_comments',
	    'label' => trans('manage.devSettings.posts-cats.add.have_comments'),
	    'value' => isset($model)? $model->have_comments : '',
	])

	@include('forms.check' , [
	    'name' => 'is_gallery',
	    'label' => trans('manage.devSettings.posts-cats.add.is_gallery'),
	    'value' => isset($model)? $model->is_gallery : '',
	])

	@include('forms.check' , [
	    'name' => 'is_hidden',
	    'label' => trans('manage.devSettings.posts-cats.add.is_hidden'),
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
		'link' => '/manage/devSettings/posts-cats'
	])

	@include('forms.group-end')

	@include('forms.feed' , [
	])

	{!! Form::close() !!}
@endsection
