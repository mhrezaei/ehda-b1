@extends('manage.frame.use.0')

@section('section')

	@if(!$model->id)
		<div id="divInquiry">
			@include('manage.cards.editor-inquiry')
		</div>
	@endif
	<div id="divForm" class="{{ $model->id? '' : 'noDisplay' }}">
		@include('manage.cards.editor-form')
	</div>
	<div id="divCard" class="noDisplay text-center">
		@include('manage.cards.editor-card')
	</div>

@endsection