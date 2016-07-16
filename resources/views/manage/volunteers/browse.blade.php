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
	@include('manage.frame.widgets.grid-start' , [
		'selector' => true ,
		'headings' => [
			trans('validation.attributes.name_first') ,
			trans('validation.attributes.home_city'),
			trans('validation.attributes.occupation'),
			trans('validation.attributes.status'),
			trans('forms.button.action'),
		],
	])

	@foreach($model_data as $model)
		<tr id="tr-{{$model->id}}" class="grid" ondblclick="gridSelector('tr','{{$model->id}}')">
			@include('manage.volunteers.browse-row' , ['model'=>$model])
		</tr>
	@endforeach

	@include('manage.frame.widgets.grid-end')

	{{--
	|--------------------------------------------------------------------------
	| Ajax Called Modal
	|--------------------------------------------------------------------------
	|
	--}}
	@include('templates.modal.ajax' , [
		'modal_id' => 'modalSetPassword' ,
		'form_url' => 'manage/volunteers/set_password/save',
		'hidden_vars' => [
			url('manage/devSettings/volunteers/-id-/set_password-'),
			trans('manage.devSettings.states.city-edit') ,
		],
	])

@endsection