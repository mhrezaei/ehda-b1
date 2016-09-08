<div class="panel panel-toolbar">
	@include('manage.frame.widgets.toolbar_button' , [
		'target' => 'manage/devSettings/branches/new' ,
		'type' => 'success' ,
		'caption' => trans('forms.button.add') ,
		'icon' => 'plus-circle' ,
	])
</div>

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
						<a href="{{ url("manage/devSettings/branches/$model->id") }}">
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