@extends('manage.frame.use.0')

@section('section')
	@include('manage.cards.tabs')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-6">
			<p class="title">
				{{$page[1][1] or ''}}
				@if(isset($volunteer))
					<span class="f8 mv5 text-grey">
						({{ trans('posts.manage.created_by' , ['name' => $volunteer->fullName(),]) }})
					</span>
				@endif
			</p>
		</div>
		<div class="col-md-6 tools">

			@if(Auth::user()->can('cards.create'))
				@include('manage.frame.widgets.toolbar_button' , [
					'target' => url('manage/cards/create') ,
					'type' => 'success' ,
					'caption' => trans('people.cards.manage.create') ,
					'icon' => 'plus-circle' ,
				])
			@endif

			@if(Auth::user()->can('cards.bulk'))
				@include('manage.frame.widgets.grid-action' , [
					'id' => '0',
					'button_size' => 'md' ,
					'button_class' => 'primary' ,
					'button_label' => trans('forms.button.bulk_action'),
					'button_extra' => 'disabled' ,
					'actions' => [
//						['envelope-o' , trans('people.commands.send_email') , 'modal:manage/cards/-id-/email' , 'cards.send' ] ,
						['mobile' , trans('people.commands.send_sms') , 'modal:manage/cards/-id-/sms' , 'cards.send' ] ,
						['print' , trans('forms.button.card_print') , 'modal:manage/cards/-id-/print' , 'cards.print' ] ,
//						['times' , trans('forms.button.hard_delete') , 'modal:manage/cards/-id-/delete' , 'cards.delete' , $page[1][2]!='bin'] ,

					]
				])
			@endif

			@if(Auth::user()->can('cards.search'))
				@include('manage.frame.widgets.toolbar_search_inline' , [
					'target' => url('manage/cards/search/') ,
					'label' => trans('people.commands.search') ,
					'value' => isset($keyword)? $keyword : '' ,
				])
			@endif
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
			trans('people.cards.manage.register'),
			trans('validation.attributes.status'),
			trans('forms.button.action'),
		],
	])

	@foreach($model_data as $model)
		<tr id="tr-{{$model->id}}" class="grid" ondblclick="gridSelector('tr','{{$model->id}}')">
			@include('manage.cards.browse-row' , ['model'=>$model])
		</tr>
	@endforeach

	@include('manage.cards.browse-null')

	@include('manage.frame.widgets.grid-end')

	<div class="paginate">
		{!! $model_data->render() !!}
	</div>

@endsection