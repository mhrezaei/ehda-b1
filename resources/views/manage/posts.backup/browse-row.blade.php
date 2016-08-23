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
			['pencil' , trans('manage.permits.edit') , "url:manage/posts/-id-/edit" , '*' , $model->canEdit()],

			['check' , trans('validation.attributes.publish') , 'modal:manage/posts/-id-/publish' , "$module.publish" , !$model->published_at],

			['trash-o' , trans('forms.button.soft_delete') , 'modal:manage/posts/-id-/soft_delete' , "$module.delete" , !$model->trashed()] ,
			['undo' , trans('forms.button.undelete') , 'modal:manage/posts/-id-/undelete' , "$module.bin" , $model->trashed()] ,
			['times' , trans('forms.button.hard_delete') , 'modal:manage/posts/-id-/hard_delete' , "$module.bin" , $model->trashed()] ,


		],
	])
</td>