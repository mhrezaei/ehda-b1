@extends('manage.frame.use.0')

@section('section')
	@include('manage.volunteers.tabs')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title">{{$page[1][1] or ''}}</p></div>
		<div class="col-md-8 tools">

			{{--@include('manage.frame.widgets.toolbar_button' , [--}}
				{{--'target' => "modalForm('modalStateEditor' , '0' , '')" ,--}}
				{{--'type' => 'success' ,--}}
				{{--'caption' => trans('forms.button.add') ,--}}
				{{--'icon' => 'plus-circle' ,--}}
			{{--])--}}
			{{--@include('manage.frame.widgets.toolbar_search' , [--}}
				{{--'target' => url('manage/devSettings/states/search/-key-') ,--}}
				{{--'label' => trans('manage.devSettings.states.city-search') ,--}}
			{{--])--}}
		</div>
	</div>


	{{--
	|--------------------------------------------------------------------------
	| Grid
	|--------------------------------------------------------------------------
	|
	--}}
	{{ $model_data->count() }}

	{{--
	|--------------------------------------------------------------------------
	| Ajax Called Modal
	|--------------------------------------------------------------------------
	|
	--}}
		@include('templates.modal.ajax' , [
			'modal_id' => 'modalStateEditor' ,
			'form_url' => 'manage/devSettings/cities/save',
			'hidden_vars' => [
				url('manage/devSettings/states/-id-/edit/-parent-'),
				trans('manage.devSettings.states.city-add') ,
				trans('manage.devSettings.states.city-edit') ,
			],
		])

@endsection