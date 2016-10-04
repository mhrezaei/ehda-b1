@extends('manage.frame.use.0')

@section('section')

	@if(!$model->id)
		<div id="divInquiry">
			@include('manage.volunteers.editor-inquiry')
		</div>
	@endif
	<div id="divForm" class="{{ $model->id? '' : 'noDisplay' }}">
		@include('manage.volunteers.editor-form')
	</div>

@endsection