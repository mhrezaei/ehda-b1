<td>
	<input id="gridSelector-{{$model->id}}" data-value="{{$model->id}}" class="gridSelector" type="checkbox" onchange="gridSelector('selector','{{$model->id}}')">
</td>
<td>
	{{ $model->say('title') }}
</td>


<td>
	<div class="text-{{$model->status('color')}}">
		{{ $model->status('text') }}
	</div>
	<div class="mv10 f10 text-grey">
		{{ trans('posts.manage.created_by' , ['name'=>$model->say('created')])  }}
	</div>
	@if($model->published_by)
		<div class="mv10 f10 text-grey">
			{{ trans('posts.manage.published_by' , ['name'=>$model->say('published')])  }}
		</div>
	@endif
	@if($model->trashed())
		<div class="mv10 f10 text-grey">
			{{ trans('posts.manage.deleted_by' , ['name'=>$model->say('deleted')])  }}
		</div>
	@endif
</td>

<td>-</td>


<td>
	@include('manage.frame.widgets.grid-action' , [
		'id' => $model->id ,
		'actions' => [
			['eye' , trans('manage.permits.view') , "urlN:".$model->say('link')],
			['pencil' , trans('manage.permits.edit') , "url:manage/posts/-id-/edit" , '*' , $model->canEdit()],

			['check' , trans('validation.attributes.publish') , 'modal:manage/posts/-id-/publish' , "$module.publish" , !$model->published_at],

			['trash-o' , trans('forms.button.soft_delete') , 'modal:manage/posts/-id-/soft_delete' , "$module.delete" , !$model->trashed()] ,
			['undo' , trans('forms.button.undelete') , 'modal:manage/posts/-id-/undelete' , "$module.bin" , $model->trashed()] ,
			['times' , trans('forms.button.hard_delete') , 'modal:manage/posts/-id-/hard_delete' , "$module.bin" , $model->trashed()] ,


		],
	])
</td>