@extends('manage.frame.use.0')

@section('section')
	@include('manage.settings.dev_tab')


	@include('forms.opener',[
		'url' => 'that' ,
		'title' => trans('manage.devSettings.posts-cats.add.trans'),
	])

	@include('forms.input' , [
	    'name' =>	'title',
	    'value' =>	'',
	    'class' => 'form-required' ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
	])

	@include('forms.input' , [
	    'name' =>	'slug',
	    'class' =>	'form-required ltr',
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.english-only'),
	])

	@include('forms.group-start')

	@include('forms.check' , [
	    'name' => 'have_rss',
	    'label' => trans('manage.devSettings.posts-cats.add.have_rss'),
	    'value' => '',
	])

	@include('forms.check' , [
	    'name' => 'have_comments',
	    'label' => trans('manage.devSettings.posts-cats.add.have_comments'),
	    'value' => '',
	])

	@include('forms.check' , [
	    'name' => 'is_gallery',
	    'label' => trans('manage.devSettings.posts-cats.add.is_gallery'),
	    'value' => '',
	])

	@include('forms.check' , [
	    'name' => 'is_hidden',
	    'label' => trans('manage.devSettings.posts-cats.add.is_hidden'),
	    'value' => '',
	])
	@include('forms.group-end')

	@include('forms.group-start')

	@include('forms.button' , [
		'label' => trans('forms.button.save'),
		'shape' => 'success',
	])

	@include('forms.group-end')

	@include('forms.feed' , [
	])


	{!! Form::close() !!}
@endsection
