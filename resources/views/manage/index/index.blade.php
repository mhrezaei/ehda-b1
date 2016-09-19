@extends('manage.frame.use.0')

@section('page_heading' , trans('manage.modules.dashboard'))

@section('section')

	@include('manage.index.hello')

	<div class="row">
		@foreach($digests as $digest)
			@include('manage.frame.widgets.digest' , $digest)
		@endforeach
	</div>


@endsection

{{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTest">Small modal</button>--}}
