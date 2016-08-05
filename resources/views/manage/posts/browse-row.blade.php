<td>
	<input id="gridSelector-{{$model->id}}" data-value="{{$model->id}}" class="gridSelector" type="checkbox" onchange="gridSelector('selector','{{$model->id}}')">
</td>
<td>
	{{ $model->say('title') }}
</td>


<td>
	{{ $model->say('created') }}
</td>


<td>
	{{ $model->say('published') }}
</td>

<td>-</td>


<td>
	@include('manage.frame.widgets.grid-action' , [
		'id' => $model->id ,
		'actions' => [
			['eye' , trans('manage.permits.view') , "urlN:manage/volunteers/-id-/view"], //@TODO: Put the correct url
			['pencil' , trans('manage.permits.edit') , "modal:manage/volunteers/-id-/edit" , "$module.edit"],

			['check' , trans('validation.attributes.publish') , 'modal:manage/volunteers/-id-/publish' , "$module.publish" , !$model->published_at],

			['trash-o' , trans('people.commands.soft_delete') , 'modal:manage/volunteers/-id-/soft_delete' , "$module.delete" , !$model->trashed()] ,
			['undo' , trans('people.commands.undelete') , 'modal:manage/volunteers/-id-/undelete' , "$module.bin" , $model->trashed()] ,
			['times' , trans('people.commands.hard_delete') , 'modal:manage/volunteers/-id-/hard_delete' , "$module.bin" , $model->trashed()] ,


		],
	])
</td>