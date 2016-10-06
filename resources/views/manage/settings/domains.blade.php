@extends('manage.frame.use.0')

@section('section')
	@include('manage.settings.tabs_dev')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title">{{ trans('manage.devSettings.domains.trans') }}</p></div>
		<div class="col-md-8 tools">
			@include('manage.frame.widgets.toolbar_button' , [
				'target' => "masterModal(url('manage/devSettings/domains/0/edit'))" ,
				'type' => 'success' ,
				'caption' => trans('forms.button.add') ,
				'icon' => 'plus-circle' ,
			])
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
					<td>{{ trans('validation.attributes.title') }}</td>
					<td>{{ trans('validation.attributes.slug') }}</td>
					<td>{{ trans('validation.attributes.alias') }}</td>
					<td>{{ trans('manage.devSettings.domains.cities') }}</td>
				</tr>
				</thead>
				<tbody>
				@foreach($model_data as $model)
					<tr>
						<td id="domain-{{$model->id}}-title" data-toggle="{{$model->title}}">
							<a href="javascript:void(0)" onclick="masterModal(url('manage/devSettings/domains/{{$model->id}}/edit'))">
								{{ $model->title }}
							</a>
						</td>
						<td id="domain-{{$model->id}}-slug" data-toggle="{{$model->slug}}" >
							{{ $model->slug }}
						</td>
						<td id="domain-{{$model->id}}-alias" data-toggle="{{$model->alias}}" >
							@if(!$model->alias)
								<span class="null-content">{{ trans('manage.devSettings.domains.domain_deactive') }}</span>
							@else
								{{ $model->alias }}
							@endif
						</td>
						<td>
							<a href="{{url('manage/devSettings/domains/'.$model->id)}}" >
								@pd($model->states()->count().' '.trans('manage.devSettings.domains.city'))
							</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>


@endsection
