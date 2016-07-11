@extends('manage.frame.use.0')

@section('section')
	@include('manage.settings.dev_tab')
	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}

	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title">{{$page[2][1]}}</p></div>
		<div class="col-md-8 tools">

			@if($model_data->count()>0)
				@include('manage.frame.widgets.toolbar_button' , [
					'target' => "modalForm('modalStateEditor' , '0' , '".$model_data->first()->province()->id."')" ,
					'type' => 'success' ,
					'caption' => trans('forms.button.add') ,
					'icon' => 'plus-circle' ,
				])
			@endif
			@include('manage.frame.widgets.toolbar_search' , [
				'target' => url('manage/devSettings/states/search/-key-') ,
				'label' => trans('manage.devSettings.states.city-search') ,
			])
		</div>
	</div>

	{{--
	|--------------------------------------------------------------------------
	| Grid
	|--------------------------------------------------------------------------
	|
	--}}

	<div class="panel panel-default m20">
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
				<tr>
					<td>{{ trans('manage.devSettings.domains.city') }}</td>
					<td>{{ trans('manage.devSettings.states.province-title') }}</td>
					<td>{{ trans('manage.devSettings.domains.domain') }}</td>
					{{--<td>{{ trans('validation.attributes.capital_id') }}</td>--}}
				</tr>
				</thead>
				<tbody>
				@foreach($model_data as $model)
					<tr>
						<td id="domain-{{$model->id}}-title" data-toggle="{{$model->title}}">
							<a href="javascript:void(0)" onclick="modalForm('modalStateEditor' , '{{$model->id}}')">
								{{ $model->title }}
							</a>
						</td>
						<td id="domain-{{$model->id}}-province" data-toggle="{{$model->province()->id}}">
							<a href="javascript:void(0)" onclick="modalForm('modalStateEditor' , '{{$model->province()->id}}')">
								{{ $model->province()->title }}
							</a>
						</td>
						<td>
							{{ $model->domain->title }}
						</td>
						{{--<td>--}}
							{{--@if($model->capital()->id == $model->id)--}}
								{{--<span class="fa fa-check text-success"></span>--}}
							{{--@else--}}
								{{--<span>&nbsp;</span>--}}
							{{--@endif--}}
						{{--</td>--}}
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>

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