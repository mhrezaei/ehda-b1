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
	@if($model->trashed())
		<div class="text text-danger">
			{{ trans('people.volunteers.status.blocked') }}
		</div>
	@elseif(!$model->published_at and !$model->exam_passed_at)
		<div class="text text-info">
			{{ trans('people.volunteers.status.examining') }}
		</div>
	@elseif(!$model->published_at)
		<div class="text text-warning">
			{{ trans('people.volunteers.status.pending') }}
		</div>
	@elseif($model->unverified_flag)
		<div class="text text-warning">
			{{ trans('people.volunteers.status.care') }}
		</div>
	@else
		<div class="text text-success">
			{{ trans('people.volunteers.status.active') }}
		</div>
	@endif
</td>

<td>
	@include('manage.frame.widgets.grid-action' , [
		'id' => $model->id ,
		'actions' => [
			['eye' , trans('manage.permits.view') , "modal:manage/volunteers/-id-/view" , 'volunteers.view'],
			['key' , trans('people.commands.change_password') , 'modal:manage/volunteers/-id-/change_password' , 'volunteers.edit' ,  $model->isActive() ],
			['pencil' , trans('manage.permits.edit') , "modal:manage/volunteers/-id-/edit" , 'volunteers.edit'],
			['shield' , trans('manage.permits.permits') , 'modal:manage/volunteers/-id-/permits' , 'volunteers.permits' , $model->isActive()],

			['envelope-o' , trans('people.commands.send_email') , 'modal:manage/volunteers/-id-/email' , 'volunteers.send' , $model->email ] ,
			['mobile' , trans('people.commands.send_sms') , 'modal:manage/volunteers/-id-/sms' , 'volunteers.send' , $model->tel_mobile ] ,

			['check' , trans('people.commands.activate') , 'modal:manage/volunteers/-id-/publish' , 'volunteers.publish' , !$model->published_at],
			['trash-o' , trans('people.commands.soft_delete') , 'modal:manage/volunteers/-id-/soft_delete' , 'volunteers.delete' , !$model->trashed()] ,
			['undo' , trans('people.commands.undelete') , 'modal:manage/volunteers/-id-/undelete' , 'volunteers.bin' , $model->trashed()] ,
			['times' , trans('people.commands.hard_delete') , 'modal:manage/volunteers/-id-/hard_delete' , 'volunteers.bin' , $model->trashed()] ,


		],
	])
</td>