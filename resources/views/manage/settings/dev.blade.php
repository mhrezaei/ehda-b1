@extends('manage.frame.use.0')

@section('section')
	@include('manage.settings.dev_tab')

	@include("manage.settings.".$page[1][0])
@endsection
