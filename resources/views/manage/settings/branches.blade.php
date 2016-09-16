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
				'target' => "masterModal('".url('manage/devSettings/branches/0')."')" ,
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
					<td>{{ trans('validation.attributes.title') }}</td>
					<td>{{ trans('validation.attributes.slug') }}</td>
					<td>{{ trans('validation.attributes.template') }}</td>
					<td>{{ trans('manage.devSettings.branches.features') }}</td>
				</tr>
				</thead>
				<tbody>
				@foreach($model_data as $model)
					<tr>
						<td>
							<a href="javascript:void(0)" onclick="masterModal('{{url('manage/devSettings/branches/'.$model->id)}}')">
								<i class="fa fa-{{$model->icon}}"></i>
								{{ $model->title() }}
							</a>
						</td>
						<td>{{ $model->slug }}</td>
						<td>{{ $model->template }}</td>
						<td>{{ $model->features }}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>


@endsection
