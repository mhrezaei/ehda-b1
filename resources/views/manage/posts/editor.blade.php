@extends('manage.frame.use.0')

@section('section')

	@include('manage.posts.editor-warnings')
	@if($model->deleted_at)
		@include('manage.posts.editor-undelete')
	@endif

	@include('forms.opener' , [
		'id' => 'frmEditor',
		'url' => 'manage/posts/save',
		'files' =>true,
		'title' => $model->id ? trans('posts.manage.edit') : trans('posts.manage.create' ,[
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

			@include('forms.textarea' , [
			    'name' => 'text',
			    'id' => 'txtText' ,
			    'class' => 'form-required tinyEditor',
			    'value' => $model->text ,
			    'rows' => 10,
			])


			@include('forms.textarea' , [
			    'name' => 'abstract',
			    'value' => $model->abstract ,
			    'hint' => trans('posts.manage.abstract_hint'),
			    'rows' => 4,
			])

			@include('forms.select' , [
				'name' => 'category_id' ,
				'value' => $model->category_id  ,
				'options' => $model->branch()->categories ,
				'blank_value' => '',
				'blank_label' => trans('posts.categories.without')
			])

			@include('forms.textarea' , [
			    'name' => 'keywords',
			    'value' => $model->keywords ,
			    'hint' => trans('posts.manage.keywords_hint'),
			    'rows' => 2,
			])

			@if($domains->count()>1)
				@include('forms.group-start' , [
					'label' => trans('validation.attributes.domain_id') ,
					'class' => 'form-required'
				])

					<div class="row">
						@foreach($domains->get() as $domain)
							<div class="col-md-4">
								@include('forms.check' , [
									'name' => "domain_".$domain->slug,
									'label' => $domain->title,
									'value' => str_contains($model->domains , '|'.$domain->slug.'|'),
									'class' => '-domain'
								])
							</div>
						@endforeach
					</div>
					<a href="javascript:void(0)" class="btn btn-xs btn-link" onclick="$('.-domain').prop('checked', true)">{{ trans('forms.general.all') }}</a>
					<a href="javascript:void(0)" class="btn btn-xs btn-link" onclick="$('.-domain').prop('checked', false)">{{ trans('forms.general.none') }}</a>

				@include('forms.group-end')
			@endif

		</div>


		{{--
		|--------------------------------------------------------------------------
		| Small Side
		|--------------------------------------------------------------------------
		| For the buttons, keywords and publish options
		--}}

		<div class="col-md-3">

			@include('manage.posts.editor-status')
			@if(!$model->trashed())
				@include('manage.posts.editor-saves')
			@endif
			@include('manage.posts.editor-schedule')

			@include('manage.posts.editor-image')
			@include('manage.posts.editor-creator')

		</div>
	</div>

	@include('forms.closer')
@endsection