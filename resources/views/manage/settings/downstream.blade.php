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
		<div class="col-md-4"><p class="title">{{ trans('manage.devSettings.downstream.trans') }}</p></div>
		<div class="col-md-8 tools">

			@include('manage.frame.widgets.toolbar_button' , [
				'target' => "masterModal('".url('manage/devSettings/downstream/0/edit/')."')" ,
				'type' => 'success' ,
				'caption' => trans('forms.button.add') ,
				'icon' => 'plus-circle' ,
			])
			@include('manage.frame.widgets.toolbar_search' , [
				'target' => url('manage/devSettings/downstream/search/-key-') ,
				'label' => trans('forms.button.search') ,
				'value' => isset($key)? $key : '' ,
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
					<td>{{ trans('validation.attributes.title') }}</td>
					<td>{{ trans('validation.attributes.category_id') }}</td>
					<td>{{ trans('validation.attributes.data_type') }}</td>
					<td>{{ trans('validation.attributes.value') }}</td>
					<td>{{ trans('manage.devSettings.domains.trans') }}</td>
				</tr>
				</thead>
				<tbody>
				@foreach($model_data as $key=> $model)
					<tr>
						<td>
							@pd($key+1)
						</td>
						<td>
							<a href="javascript:void(0)" onclick="masterModal('{{url("manage/devSettings/downstream/$model->id/edit")}}')">
								{{ $model->title }}
							</a>
							<i class="mh5 text-grey f10">{{ $model->slug }}</i>
							@if($model->developers_only)
								<i class="fa fa-minus-circle text-danger"></i>
							@endif
						</td>
						<td>
							{{ trans("manage.devSettings.downstream.category.$model->category") }}
						</td>
						<td>
							{{ trans("manage.devSettings.downstream.data_type.$model->data_type")  }}
						</td>
						<td>
							<a href="javascript:void(0)" onclick="masterModal('{{url("manage/devSettings/downstream/$model->id")}}')">
								@if($model->global_value)
									@if($model->data_type== 'text' or $model->data_type== 'textarea')
										{{ str_limit($model->global_value , 100) }}
									@elseif($model->data_type == 'boolean')
										<i class="fa fa-check"></i>
									@elseif($model->data_type == 'date')
										@pd(jdate($model->global_value)->format('Y/m/d'))
									@elseif($model->data_type == 'photo')
										<i class="fa fa-image"></i>
									@endif
								@else
									<i class="text-grey">{{ trans('manage.devSettings.downstream.unset') }}</i>
								@endif
							</a>
						</td>
						<td>
							@if($model->available_for_domains)
								<a href="javascript:void(0)" onclick="masterModal('{{url("manage/devSettings/downstream/$model->id")}}')">

									@pd(sizeof(json_decode($model->domain_value , true)))
									{{ trans('manage.devSettings.domains.domain') }}
								</a>
							@else
								<span class="null-content">{{ trans('posts.manage.global') }}</span>
							@endif
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="paginate">
		{!! $model_data->render() !!}
	</div>



@endsection