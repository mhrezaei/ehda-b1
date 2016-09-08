<td>
	<input id="gridSelector-{{$model->id}}" data-value="{{$model->id}}" class="gridSelector" type="checkbox" onchange="gridSelector('selector','{{$model->id}}')">
</td>
<td>
	<div>
		{{ $model->fullName() }}
		@if($model->isVolunteer())
			<a href="{{Auth::user()->can('volunteers.search')? url('manage/volunteers/search?keyword='.$model->code_melli.'&searched=1') : 'javascript:void(0)'}}" class="badge badge-success mh10 f7">
				{{ trans('people.volunteer') }}
			</a>
		@endif
	</div>
	<div class="mv5 f10 text-grey">
		{{ trans('validation.attributes.card_no') }}:&nbsp;
		{{ $model->say('card_no') }}
	</div>
</td>


<td>
	{{ $model->say('home_city') }}
</td>


<td>
	{{ $model->say('from_domain') }}
</td>

<td>
	<div class="text-{{ $model->cardStatus('color') }}">
		{{ $model->cardStatus() }}
	</div>
	@if($model->card_print_status)
		<div class="f10 mv5 text-{{ trans('people.card_print_status_color.'.$model->card_print_status) }}">
			{{ trans('people.cards.manage.pvc_card') }}:&nbsp;
			{{ trans('people.card_print_status.'.$model->card_print_status) }}
		</div>
	@endif
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
			['pencil' , trans('manage.permits.edit') , "url:manage/cards/-id-/edit" , 'cards.edit'],

			['print' , trans('forms.button.card_print') , 'modal:manage/cards/-id-/print' , 'cards.print' , $model->isActive('card') ] ,
			['envelope-o' , trans('people.commands.send_email') , 'modal:manage/cards/-id-/email' , 'cards.send' , $model->email ] ,
			['mobile' , trans('people.commands.send_sms') , 'modal:manage/cards/-id-/sms' , 'cards.send' , $model->tel_mobile ] ,

			['times' , trans('forms.button.hard_delete') , 'modal:manage/cards/-id-/delete' , 'cards.delete' , !$model->trashed('card')] ,
		],
	])
</td>