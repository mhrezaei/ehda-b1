@extends('manage.frame.use.0')

@section('section')
	@include('manage.settings.tabs')

	@include('forms.opener' , [
		'id' => 'frmEditor',
		'url' => 'manage/settings/save',
		'title' => $page[1][1] ,
		'class' => 'js' ,
	])

		@foreach($model_data as $domain)  {{-- This $domain serves as an alias instead of $model--}}
			@include('manage.settings.downstream-value-'.$domain->data_type , [
				'value' => $domain->value($request_domain)
			])
		@endforeach

		@include('forms.sep')

		@include('forms.group-start')

			@include('forms.button' , [
				'label' => trans('forms.button.save'),
				'shape' => 'success',
				'type' => 'submit' ,
			])

			@include('forms.button' , [
				'label' => trans('forms.button.undo_changes'),
				'shape' => 'link',
				'type' => 'button' ,
				'class' => 'text-grey' ,
				'link' => 'location.reload();' ,
			])

		@include('forms.group-end')

		@include('forms.feed' , [])

	@include('forms.closer')

@endsection