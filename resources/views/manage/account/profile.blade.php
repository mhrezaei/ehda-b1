@extends('manage.frame.use.0')

@section('section')
	@include('manage.account.tabs')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title">{{$page[1][1] or ''}}</p></div>
	</div>

	{{--
	|--------------------------------------------------------------------------
	| Form
	|--------------------------------------------------------------------------
	|
	--}}

	@include('forms.opener' , [
		'url' => 'manage/account/save/profile',
		'class' => 'js mv20' ,
		'no_validation' => 1
	])

		{{-- Notes ...--}}

		@if($model->volunteer_status<8)
			@include("forms.note" , [
				'text' => trans('manage.account.profile_completions_note_for_new_volunteers'),
				'shape' => "info" ,
			]     )
		@elseif($model->unverified_flag < 0)
			@include('forms.note' , [
				'text' => trans('manage.account.profile_reject_note') ,
				'shape' => 'danger' ,
			])
			@if($edit_reject_notice = $model->meta('edit_reject_notice'))
				@include('forms.note' , [
					'text' => trans('validation.attributes.reject_reason').": $edit_reject_notice" ,
					'shape' => 'warning' ,
				])
			@endif
		@elseif($model->unverified_flag > 0)
			@include('forms.note' , [
				'text' => trans('manage.account.profile_pending_note')
			])
		@endif



		@include('manage.account.profile-inside' , ['show_unchanged' => true])

		@include('forms.group-start')

		@include('forms.button' , [
			'label' => $model->volunteer_status<8? trans('forms.button.save') : trans('manage.account.profile_save'),
			'shape' => 'primary',
			'type' => 'submit' ,
			'value' => 'save',
		])

		@if($model->volunteer_status>=8)
			@include('forms.button' , [
				'label' => trans('manage.account.profile_revert'),
				'shape' => 'danger',
				'type' => 'submit' ,
				'value' => 'revert',
			])
		@endif

	@include('forms.group-end')

	@include('forms.feed' , [])

@include('forms.closer')



@endsection