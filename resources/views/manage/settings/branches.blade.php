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
		<div class="col-md-4"><p class="title">{{ trans('manage.devSettings.branches.trans') }}</p></div>
		<div class="col-md-8 tools">
			@include('manage.frame.widgets.toolbar_button' , [
				'target' => "masterModal('".url('manage/devSettings/branches/0/edit')."')" ,
				'type' => 'success' ,
				'caption' => trans('forms.button.add') ,
				'icon' => 'plus-circle' ,
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
					<td colspan="2">{{ trans('validation.attributes.title') }}</td>
					<td>{{ trans('validation.attributes.header_title') }}</td>
					<td>{{ trans('validation.attributes.slug') }}</td>
					<td>{{ trans('validation.attributes.template') }}</td>
					<td>{{ trans('manage.devSettings.categories.trans') }}</td>
				</tr>
				</thead>
				<tbody>
				@foreach($model_data as $model)
					<tr>
						<td>
							<i class="fa fa-{{$model->icon}}"></i>
						</td>
						<td>
							<a href="javascript:void(0)" onclick="masterModal('{{url("manage/devSettings/branches/$model->id/edit")}}')">
								{{ $model->title() }}
							</a>
						</td>
						<td>{{ $model->header_title }}</td>
						<td>{{ $model->slug }}</td>
						<td>{{ $model->template }}</td>
						<td>
							@if(!$model->hasFeature('category'))
								<span class="null-content">
									{{ trans('manage.devSettings.categories.disabled') }}
								</span>
							@else
								<a href="{{url("manage/devSettings/branches/$model->id")}}">
									@pd($model->categories()->count())
									{{ trans('manage.devSettings.categories.single') }}
								</a>
							@endif
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>


@endsection
