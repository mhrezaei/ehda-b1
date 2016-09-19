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
		<div class="col-md-4"><p class="title">{{ trans('manage.devSettings.categories.trans') }}</p></div>
		<div class="col-md-8 tools">

			@include('manage.frame.widgets.toolbar_button' , [
				'target' => "masterModal('".url('manage/devSettings/categories/0/edit/'.$branch->id)."')" ,
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
					<td>#</td>
					<td>{{ trans('manage.devSettings.categories.title') }}</td>
					<td>{{ trans('validation.attributes.slug') }}</td>
				</tr>
				</thead>
				<tbody>
				@foreach($model_data as $key=> $model)
					<tr>
						<td>
							@pd($key+1)
						</td>
						<td>
							<a href="javascript:void(0)" onclick="masterModal('{{url("manage/devSettings/categories/$model->id/edit")}}')">
								{{ $model->title }}
							</a>
						</td>
						<td>
							{{ $model->slug  }}
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>


@endsection