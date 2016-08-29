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
				<td>{{ trans('manage.devSettings.branches.have_rss') }}</td>
				<td>{{ trans('manage.devSettings.branches.have_comments') }}</td>
				<td>{{ trans('validation.attributes.content') }}</td>
				<td>{{ trans('manage.devSettings.branches.is_hidden') }}</td>
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
					<td>
						@if($model->have_rss)
							<span class="fa fa-check text-success"></span>
						@else
							<span class="fa fa-times text-warning"></span>
						@endif
					</td>
					<td>
						@if($model->have_comments)
							<span class="fa fa-check text-success"></span>
						@else
							<span class="fa fa-times text-warning"></span>
						@endif
					</td>
					<td>{{ $model->is_gallery? trans('manage.devSettings.branches.content_pics') : trans('manage.devSettings.branches.content_text') }}</td>
					<td>
						@if($model->is_hidden)
							<span class="fa fa-check text-success"></span>
						@else
							<span class="fa fa-minus"></span>
						@endif
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>