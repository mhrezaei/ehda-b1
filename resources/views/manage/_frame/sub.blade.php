@extends('manage.frame.main')

@section('body')
	@include('manage.frame.navbar')
	<div class="row">
		<div class="col-md-1">
			@include('manage.frame.sidebar')
		</div>
		<div class="col-md-11">
			@yield('content')
		</div>
	</div>


@endsection