@include('manage.settings.domains-modalEditor')
@include('manage.settings.domains-modalCities')

<div class="panel panel-toolbar">
	@include('manage.frame.widgets.toolbar_button' , [
		'target' => 'domainEditor("0")' ,
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
				<td>{{ trans('manage.devSettings.domains.admin') }}</td>
				<td>{{ trans('manage.devSettings.domains.cities') }}</td>
			</tr>
			</thead>
			<tbody>
			@foreach($model_data as $model)
				<tr>
					<td id="domain-{{$model->id}}-title" data-toggle="{{$model->title}}">
						<a href="javascript:void(0)" onclick="domainEditor('{{$model->id}}')">
							{{ $model->title }}
						</a>
					</td>
					<td id="domain-{{$model->id}}-slug" data-toggle="{{$model->slug}}" >
						{{ $model->slug }}
					</td>
 					<td>@pd('as123')</td>
					<td>
						<a href="javascript:void(0)" onclick="domainCities('{{$model->id}}')">
							@pd($model->states()->count().' '.trans('manage.devSettings.domains.city'))
						</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>