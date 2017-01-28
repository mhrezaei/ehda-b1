<td>
	<input id="gridSelector-{{$model->id}}" data-value="{{$model->id}}" class="gridSelector" type="checkbox" onchange="gridSelector('selector','{{$model->id}}')">
</td>
<td>
	@include("manage.frame.widgets.grid-text" , [
		'text' => $model->fullName(),
		'link' => "modal:manage/cards/-id-/view",
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'text' => trans('validation.attributes.card_no').': '.$model->say('card_no'),
		'icon' => "credit-card",
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'condition' => $model->isVolunteer(),
		'text' => trans('people.volunteer'),
		'color' => "success",
		'link' => Auth::user()->can('volunteers.search')? 'url:manage/volunteers/search?keyword='.$model->code_melli.'&searched=1' : '',
	])
</td>


<td>
	@include("manage.frame.widgets.grid-text" , [
		'text' => $model->say('home_city'),
	])
</td>

<td>
	@include("manage.frame.widgets.grid-date" , [
		'size' => "11",
//		'text' => trans('validation.attributes.card_registered_at'),
		'date' => $model->card_registered_at,
		'color' => "black",
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'fake' => $domain = $model->say('from_domain'),
		'condition' => $domain != '-',
		'text' => $domain,
	])
	@include("manage.frame.widgets.grid-tiny" , [
		'condition' => $model->event_id>0,
		'text' => $model->event ? $model->event->title : '-' ,
	])
</td>


<td>
	<div class="text-{{ $model->cardStatus('color') }}">
		{{ $model->cardStatus() }}
	</div>
	@if($model->newsletter)
		<div class="badge badge-info f7">
			{{ trans('people.cards.manage.newsletter_member') }}
		</div>
	@endif
</td>

<td>
	@include('manage.frame.widgets.grid-action' , [
		'id' => $model->id ,
		'actions' => [
			['credit-card' , trans('people.commands.view_card') , "modal:manage/cards/-id-/card" , 'cards.*'],
			['eye' , trans('people.commands.view_info') , "modal:manage/cards/-id-/view" , 'cards.view'],

			['key' , trans('people.commands.change_password') , 'modal:manage/cards/-id-/change_password' , 'cards.edit' ,  $model->isActive('card') ],
			['pencil' , trans('manage.permits.edit') , "url:manage/cards/-id-/edit" , $model->isActiveVolunteer()? 'volunteers.edit' : 'cards.edit'],

			['print' , trans('forms.button.card_print') , 'modal:manage/cards/-id-/print' , 'cards.print' , $model->isActive('card') ] ,
//			['envelope-o' , trans('people.commands.send_email') , 'modal:manage/cards/-id-/email' , 'cards.send' , $model->email ] ,
//			['mobile' , trans('people.commands.send_sms') , 'modal:manage/cards/-id-/sms' , 'cards.send' , $model->tel_mobile ] ,

			['user-plus' , trans('people.cards.manage.add_as_volunteer') , 'url:manage/volunteers/-id-/edit' , 'volunteers.create' , !$model->isVolunteer()] ,
			['times' , trans('forms.button.hard_delete') , 'modal:manage/cards/-id-/delete' , 'cards.delete' , !$model->trashed('card')] ,
		],
	])
</td>