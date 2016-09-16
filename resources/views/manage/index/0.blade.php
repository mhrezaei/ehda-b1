@extends('manage.frame.use.0')

@section('page_heading' , trans('manage.modules.dashboard'))

@section('section')

	@foreach($digests as $digest)
		@include('manage.frame.widgets.digest' , $digest)
	@endforeach


@endsection

{{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTest">Small modal</button>--}}
