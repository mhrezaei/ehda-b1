{{--
|--------------------------------------------------------------------------
| Toolbar
|--------------------------------------------------------------------------
|
--}}

<div class="panel panel-toolbar row w100">
	<div class="col-md-4"><p class="title">{{ trans('manage.devSettings.states.trans') }}</p></div>
	<div class="col-md-8 tools">

		@include('manage.frame.widgets.toolbar_button' , [
			'target' => 'modalForm("modalStateEditor" , "0")' ,
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
				<td>{{ trans('manage.devSettings.states.province-title') }}</td>
				<td>{{ trans('validation.attributes.capital_id') }}</td>
				<td>{{ trans('manage.devSettings.domains.cities') }}</td>
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
					<td id="domain-{{$model->id}}-capital" data-toggle="{{$model->capital()->title}}" >
						{{ $model->capital()->title }}
					</td>
					<td>
						<a href="{{url('manage/devSettings/states/'.$model->id)}}" >
							@pd($model->cities()->count().' '.trans('manage.devSettings.domains.city'))
						</a>
					</td>
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
	'form_url' => 'manage/devSettings/states/save',
	'hidden_vars' => [
		url('manage/devSettings/states/-id-/edit'),
		trans('manage.devSettings.states.province-add') ,
		trans('manage.devSettings.states.province-edit') ,
	],
])

