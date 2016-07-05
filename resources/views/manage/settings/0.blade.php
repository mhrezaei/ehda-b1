@extends('manage.frame.use.0')

@section('page_title' , trans("manage.modules.$request_module"))
@section('page_heading' , trans("manage.modules.$request_module"))

@section('section')
	@include('manage.settings.dev_tab' , [
		'tabs' => ['socials'] ,
	])

	{{--@include("manage.settings.$request_tab")--}}
@endsection
