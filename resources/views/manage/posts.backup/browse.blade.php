@extends('manage.frame.use.0')

@section('section')
	@include('manage.posts.tabs')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title">{{$page[0][1]. ': ' . $page[1][1]}}</p></div>
		<div class="col-md-8 tools">

			@include('manage.frame.widgets.toolbar_button' , [
				'target' => url('manage/posts/'.$branch->slug.'/create') ,
				'type' => 'success' ,
				'caption' => trans('posts.manage.create' , ['thing'=>$branch->title(1)]) ,
				'icon' => 'plus-circle' ,
			])

			{{--@include('manage.frame.widgets.grid-action' , [--}}
				{{--'id' => '0',--}}
				{{--'button_size' => 'md' ,--}}
				{{--'button_class' => 'primary' ,--}}
				{{--'button_label' => trans('forms.button.bulk_action'),--}}
				{{--'button_extra' => 'disabled' ,--}}
				{{--'actions' => [--}}
{{--//					['check' , trans('people.commands.activate') , 'modal:manage/posts/-id-/publish' , 'volunteers.publish' , $page[1][2]!='bin' and $page[1][2]!='active'],--}}
					{{--['trash-o' , trans('people.commands.soft_delete') , 'modal:manage/posts/-id-/soft_delete' , $branch->slug.".delete" , $page[1][2]!='bin'] ,--}}
					{{--['undo' , trans('people.commands.undelete') , 'modal:manage/posts/-id-/undelete' , $branch->slug.".bin" , $page[1][2]=='bin'] ,--}}
					{{--['times' , trans('people.commands.hard_delete') , 'modal:manage/posts/-id-/hard_delete' , $branch->slug.".bin" , $page[1][2]=='bin'] ,--}}

				{{--]--}}
			{{--])--}}

			@include('manage.frame.widgets.toolbar_search_inline' , [
				'target' => url('manage/posts/search/') ,
				'label' => trans('posts.manage.search' , ['thing'=>$branch->title(1)]) ,
			])
		</div>
	</div>


	{{--
	|--------------------------------------------------------------------------
	| Grid
	|--------------------------------------------------------------------------
	|
	--}}

	@include('manage.frame.widgets.grid-start' , [
		'selector' => true ,
		'headings' => [
			trans('validation.attributes.title') ,
			trans('validation.attributes.create') ,
			trans('validation.attributes.publish'),
			trans('posts.manage.comments'),
			trans('forms.button.action'),
		],
	])

	@foreach($model_data as $model)
		<tr id="tr-{{$model->id}}" class="grid" ondblclick="gridSelector('tr','{{$model->id}}')">
			@include('manage.posts.browse-row' , ['model'=>$model , 'module'=>$branch->slug])
		</tr>
	@endforeach

	@include('manage.volunteers.browse-null')

	@include('manage.frame.widgets.grid-end')

	<div class="paginate">
		{!! $model_data->render() !!}
	</div>

@endsection