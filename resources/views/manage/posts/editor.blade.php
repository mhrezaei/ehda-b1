@extends('manage.frame.use.0')

@section('section')
	@include('forms.opener' , [
		'url' => 'manage/posts/save',
		'files' =>true,
		'title' => isset($model)? trans('posts.manage.edit') : trans('posts.manage.create' ,[
			'thing' => $branch->title(1),
		]),
	])

	<div class="row w100">
		{{--
		|--------------------------------------------------------------------------
		| Big Side
		|--------------------------------------------------------------------------
		| For the main content
		--}}

		<div class="col-md-9">

			@include('forms.input' , [
			    'name' => 'title',
			    'value' => isset($model)? $model->title : '',
			    'class' => 'form-required form-default',
			    'hint' => trans('posts.manage.title_hint') ,
			])

			@include('forms.textarea' , [
			    'name' => 'text',
			    'class' => 'form-required tinyEditor',
			    'value' => isset($model)? $model->text : '',
			    'rows' => 10,
			])

			
			@include('forms.textarea' , [
			    'name' => 'abstract',
			    'value' => isset($model)? $model->abstract : '',
			    'hint' => trans('posts.manage.abstract_hint'),
			    'rows' => 4,
			])

			@include('forms.select' , [
				'name' => 'category_id' ,
				'value' => $model->category_id ,
				'options' => $model->branch()->categories,
				'blank_value' => '0',
				'blank_label' => trans('posts.categories.without')
			])
			
			@include('forms.textarea' , [
			    'name' => 'keywords',
			    'value' => $model->keywords,
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
									'name' => $domain->slug,
									'label' => $domain->title,
									'value' => str_contains($domain->slug , $model->domains),
									'class' => '-domain'
								])
							</div>
						@endforeach
					</div>

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
			@include('manage.posts.editor-saves')

			@if($model->canPublish())
				@include('manage.posts.editor-publish')
			@endif

			@include('manage.posts.editor-domain')


		</div>
	</div>

	@include('forms.closer')
@endsection