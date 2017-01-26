<td>
	<input id="gridSelector-{{$model->id}}" data-value="{{$model->id}}" class="gridSelector" type="checkbox" onchange="gridSelector('selector','{{$model->id}}')">
</td>
<td>
	<div>
		{{ $model->user->fullName() }}
	</div>
	<div class="mv5 f10 text-grey">
		{{ trans('validation.attributes.card_no') }}:&nbsp;
		{{ $model->user->say('card_no') }}
	</div>
</td>


<td>
	{{ $model->user->say('home_city') }}
</td>


<td>
	{{ $model->user->say('from_domain') }}
</td>

<td>
	{{ $model->event ? $model->event->title : '-'}}
</td>

{{--<td>--}}
	{{--@include('manage.frame.widgets.grid-action' , [--}}
		{{--'id' => $model->id ,--}}
		{{--'actions' => [--}}
			{{--['pencil' , trans('manage.permits.edit') , "url:manage/cards/-id-/edit" , $model->user->isActiveVolunteer()? 'volunteers.edit' : 'cards.edit'],--}}
			{{--['times' , trans('forms.button.hard_delete') , 'modal:manage/cards/-id-/delete' , 'cards.delete' , !$model->trashed('card')] ,--}}
		{{--],--}}
	{{--])--}}
{{--</td>--}}