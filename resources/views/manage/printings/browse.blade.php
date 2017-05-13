@extends('manage.frame.use.0')

@section('section')
	@include('manage.printings.tabs')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<input id="txtEventId" type="hidden" value="{{$event_id}}">
	<div class="panel panel-toolbar row w100">
		<div class="col-md-6">
			<p class="title">
				{{$page[1][1] or ''}}:{{ trans("people.printing_status.$request_tab") }}
				@if(isset($event_title))
					<span class="badge mh20 ph20">
						{{ $event_title }}
					</span>
				@endif
			</p>
		</div>
		<div class="col-md-6 tools">

			<button id="btnDownloadExcel"
					onclick="window.location='{{url("manage/cards/printings/download_excel/$event_id")}}'"
					onchange="window.open('{{url("manage/cards/printings/download_excel/$event_id")}}')"
					class="btn btn-warning {{ $request_tab != 'under_verification' ? 'noDisplay' : ''  }}" >
				<i class="fa fa-download mh10"></i>
				{{ trans("people.printings.download_excel_file") }}
			</button>



			@include('manage.frame.widgets.grid-action' , [
				'id' => '0',
				'button_size' => 'md' ,
				'button_class' => 'info' ,
				'button_label' => trans('people.printings.event_selection'),
				'actions' => $events_array
			])

			@include('manage.frame.widgets.grid-action' , [
				'id' => '0',
				'button_size' => 'md' ,
				'button_class' => 'primary' ,
				'button_label' => trans('forms.button.bulk_action'),
//					'button_extra' => 'disabled' ,
				'actions' => [
					['file-excel-o' , trans('people.commands.export_to_excel') , 'modal:manage/cards/printings/modal/-id-/excel' , 'any' , $request_tab!='under_verification'],
					['print' , trans('people.commands.direct_print') , 'modal:manage/cards/printings/modal/-id-/print' , 'any' , $request_tab!='direct_print'] ,
					['check-square-o' , trans('people.commands.confirm_good_print') , 'modal:manage/cards/printings/modal/-id-/confirm' , 'any' , $request_tab!='pending'],
//						['times' , trans('forms.button.hard_delete') , 'modal:manage/cards/printings/modal/-id-/delete' , 'cards.delete' , $page[1][2]!='bin'] ,

				]
			])


		</div>
	</div>


	{{--
	|--------------------------------------------------------------------------
	| Grid
	|--------------------------------------------------------------------------
	|
	--}}

	@include('manage.frame.widgets.grid-start' , [
		'selector' => true ,
		'headings' => [
			trans('validation.attributes.name_first') ,
			trans('validation.attributes.home_city'),
			trans('people.cards.manage.domain'),
			trans('validation.attributes.event_id'),
//			trans('forms.button.action'),
		],
	])

	@foreach($model_data as $model)
		@if($model->user)
			<tr id="tr-{{$model->id}}" class="grid" ondblclick="gridSelector('tr','{{$model->id}}')">
				@include('manage.printings.browse-row' , ['model'=>$model])
			</tr>
		@endif
	@endforeach

	@include('manage.cards.browse-null')

	@include('manage.frame.widgets.grid-end')

	<div class="paginate">
		{!! $model_data->render() !!}
	</div>

@endsection