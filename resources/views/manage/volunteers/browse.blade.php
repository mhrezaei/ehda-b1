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

			<div>
				@include('manage.frame.widgets.grid-action' , [
					'id' => '0',
					'button_size' => 'md' ,
					'button_label' => trans('forms.button.bulk_action'),
					'actions' => [
							['eye' , trans('manage.permits.view') , "modal:manage/volunteers/-id-/view" , 'volunteers.view'],
					]
				])
			</div>

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

	<div class="paginate">
		{!! $model_data->render() !!}
	</div>

@endsection