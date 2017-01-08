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
//						['mobile' , trans('people.commands.send_sms') , 'modal:manage/cards/-id-/sms' , 'cards.send' ] ,
						['print' , trans('forms.button.card_print') , 'modal:manage/cards/-id-/print' , 'cards.print' ] ,
						['times' , trans('forms.button.hard_delete') , 'modal:manage/cards/-id-/delete' , 'cards.delete' , $page[1][2]!='bin'] ,

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

	<div class="panel panel-default m20">
		<div class="panel-body">
			<table class="table {{$table_class or 'table-hover'}}">
				<thead>
					<tr>
						<td>#</td>
						<td>تاریخ</td>
						<td>آمار ثبت نام</td>
					</tr>
				</thead>

				<tbody>
					@foreach($data as $key => $item)
						<tr>
							<td>@pd($key + 1)</td>
							<td>@pd(jDate::forge($item[0])->format('j F Y'))</td>
							<td>@pd($item[1])</td>
						</tr>
					@endforeach

				</tbody>
			</table>
		</div>
	</div>

@endsection