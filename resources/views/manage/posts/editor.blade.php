@extends('manage.frame.use.0')

@section('section')

	@include('manage.posts.editor-warnings')
	@if($model->deleted_at)
		@include('manage.posts.editor-undelete')
	@endif

	@include('forms.opener' , [
		'id' => 'frmEditor',
		'url' => 'manage/posts/save',
		'files' =>false,
		'title' => $model->id ? trans('posts.manage.edit',[
			'thing' => $model->branch()->title(1),
		]) : trans('posts.manage.create' ,[
			'thing' => $model->branch()->title(1),
		]),
		'class' => 'js'
	])

	<div class="row w100">
		{{--
		|--------------------------------------------------------------------------
		| Big Side
		|--------------------------------------------------------------------------
		| For the main content
		--}}

		<div class="col-md-9">

			@include('forms.feed' , [])

			@include('forms.hiddens' , ['fields' => [
				['id' , $model->id ],
				['action' , '' , 'txtAction'] ,
				['branch' , $encrypted_branch] ,
				['is_published' , $model->published_by]
			]])


			@include('forms.input' , [
			    'name' => 'title',
			    'value' => $model->title ,
			    'class' => 'form-required form-default',
			    'hint' => trans('posts.manage.title_hint') ,
			])

			@if(Auth::user()->isDeveloper())
				@include('forms.input' , [
					'name' => 'slug',
					'value' => $model->slug ,
					'class' => 'ltr',
					'hint' => trans('posts.manage.slug_hint') ,
				])
			@endif

			@if(!$model->branch()->is_gallery)
				@include('forms.textarea' , [
					'name' => 'text',
					'id' => 'txtText' ,
					'class' => 'form-required tinyEditor',
					'value' => $model->text ,
					'rows' => 20,
				])
			@endif

			@include('forms.textarea' , [
			    'name' => 'abstract',
			    'value' => $model->abstract ,
			    'hint' => trans('posts.manage.abstract_hint'.($model->branch()->is_gallery? '_for_galleries' : '')),
			    'rows' => 4,
			])

			@include('forms.select' , [
				'name' => 'category_id' ,
				'value' => $model->category_id  ,
				'options' => $model->branch()->categories ,
				'blank_value' => '',
//				'class' => 'form-required',
				'blank_label' => trans('posts.categories.without')
			])

			@include('forms.textarea' , [
			    'name' => 'keywords',
			    'value' => $model->keywords ,
			    'hint' => trans('posts.manage.keywords_hint'),
			    'rows' => 2,
			])

			@include('manage.posts.editor-meta')
			@if($model->branch()->is_gallery)
				@include('manage.posts.editor-album')
			@endif
			{{--@include('manage.posts.editor-multidomains')--}}


		</div>


		{{--
		|--------------------------------------------------------------------------
		| Small Side
		|--------------------------------------------------------------------------
		| For the buttons, keywords and publish options
		--}}

		<div class="col-md-3">

			@include('manage.posts.editor-status')
			@include('manage.posts.editor-saves')
			@include('manage.posts.editor-image')
			@include('manage.posts.editor-domains')
			@include('manage.posts.editor-schedule')
			@include('manage.posts.editor-creator')

		</div>
	</div>

	@include('forms.closer')
@endsection