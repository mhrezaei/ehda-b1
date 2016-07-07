@extends('manage.frame.home')

@section('navbar-brand' ,view('manage.frame.use.brand',['page'=>$page]) )
@section('sidebar' , view('manage.frame.use.sidebar'))
@section('page_title' , trans("manage.modules.".$page[0][0]).' | '.trans('manage.global.page_title'))
