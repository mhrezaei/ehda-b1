<td>
	<input id="gridSelector-{{$model->id}}" data-value="{{$model->id}}" class="gridSelector" type="checkbox" onchange="gridSelector('selector','{{$model->id}}')">
</td>
<td>
	@if($model->canEdit())
		<a href="{{ url("manage/posts/".$model->branch()->slug."/edit/".$model->id) }}">
			{{ $model->say('title_limit') }}
		</a>
	@else
		{{ $model->say('title_limit') }}
	@endif


	@include("manage.frame.widgets.grid-text" , [
		'link' => "modal:manage/posts/-id-/stats" ,
		'class' => "mv20" ,
		'condition' => $model->branch=='event' and $total_cards = $model->cards()->count() ,
		'icon' => "credit-card mv10" ,
		'text' => \App\Providers\AppServiceProvider::pd($total_cards). ' ' . trans('people.cards.full_title') ,
		'color' => "success" ,
		'size' => "10" ,
	]     )

	{{--@include("manage.frame.widgets.grid-text" , [--}}
		{{--'link' => "urlN:manage/cards/printings/pending/-id-",--}}
		{{--'condition' => $model->branch=='event' and $total_prints = $model->printings()->count() ,--}}
	{{--]     )--}}
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

@if($branch->hasFeature('domain') and Auth::user()->isGlobal())
	<td>
		{{ $model->say('domains') }}
		@if(str_contains($model->domains , '*') )
			<i class="fa fa-globe mh5 text-success"></i>
		@endif
	</td>
@endif


<td>
	@include('manage.frame.widgets.grid-action' , [
		'id' => $model->id ,
		'actions' => [
//			['eye' , trans('manage.permits.view') , "urlN:".$model->say('preview')],
			['pencil' , trans('manage.permits.edit') , "url:manage/posts/".$model->branch()->slug."/edit/-id-" , '*' , $model->canEdit()],
			['times' , trans('forms.button.hard_delete') , 'modal:manage/posts/-id-/hard_delete' , "$module.bin" , $model->trashed() and Auth::user()->isDeveloper()] ,


		],
	])
</td>