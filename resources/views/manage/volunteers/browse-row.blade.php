<td>
	<input id="gridSelector-{{$model->id}}" data-value="{{$model->id}}" class="gridSelector" type="checkbox" onchange="gridSelector('selector','{{$model->id}}')">
</td>
<td>
	{{ $model->fullName() }}
</td>


<td>
	{{ $model->say('home_city') }}
</td>


<td>
	{{ $model->occupation() }}
</td>

<td>
	@if($model->isCard())
		<span class="text-success">{{ trans('forms.logic.has') }}</span>
	@else
		-
	@endif
</td>


<td>
	<span class="text-{{ $model->volunteerStatus('color') }}">
		{{ $model->volunteerStatus() }}
	</span>
</td>

<td>
	@include('manage.frame.widgets.grid-action' , [
		'id' => $model->id ,
		'actions' => [
			['eye' , trans('manage.permits.view') , "modal:manage/volunteers/-id-/view" , 'volunteers.view'],
			['copy' , trans('people.volunteers.manage.care_review') , 'modal:manage/volunteers/-id-/care_review' , 'volunteers.edit' , $model->unverified_flag>0 && $model->isActive() ],
			['key' , trans('people.commands.change_password') , 'modal:manage/volunteers/-id-/change_password' , 'volunteers.edit' ,  $model->isActive() ],
			['pencil' , trans('manage.permits.edit') , "url:manage/volunteers/-id-/edit" , 'volunteers.edit'],
			['shield' , trans('manage.permits.permits') , 'modal:manage/volunteers/-id-/permits' , 'any' , $model->canBePermitted()],

//			['envelope-o' , trans('people.commands.send_email') , 'modal:manage/volunteers/-id-/email' , 'volunteers.send' , $model->email ] ,
//			['mobile' , trans('people.commands.send_sms') , 'modal:manage/volunteers/-id-/sms' , 'volunteers.send' , $model->tel_mobile ] ,

			['check' , trans('people.commands.activate') , 'modal:manage/volunteers/-id-/publish' , 'volunteers.publish' , !$model->isActive()],
			['ban' , trans('people.commands.block') , 'modal:manage/volunteers/-id-/soft_delete' , 'volunteers.delete' , !$model->trashed()] ,
			['undo' , trans('people.commands.unblock') , 'modal:manage/volunteers/-id-/undelete' , 'volunteers.bin' , $model->trashed()] ,
			['times' , trans('people.commands.hard_delete') , 'modal:manage/volunteers/-id-/hard_delete' , 'volunteers.developer' , $model->trashed()] ,

			['user' , trans('people.commands.login_as') , 'modal:manage/volunteers/-id-/login_as' , 'volunteers.developer' , $model->isActive()] ,


		],
	])
</td>