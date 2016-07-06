@include('templates.modal.start' , [
	'modal_id' => 'modalDomainEditor' ,
	'modal_size' => 'lg',
	'form_url' => 'manage/devSettings/domains/save',
	'modal_title' => 'this',
])
	<label class="hidden _1">{{trans('manage.devSettings.domains.add')}}</label>
	<label class="hidden _2">{{ trans('manage.devSettings.domains.edit') }}</label>

	<div class='modal-body'>

		@include('forms.hidden' , [
			'name' => 'id' ,
			'value' => isset($model)? $model->id : '0',
		])

		@include('forms.input' , [
			'name' =>	'title',
			'value' =>	isset($model)? $model->title : '',
			'class' => 'form-required' ,
			'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
		])

		@include('forms.input' , [
			'name' =>	'slug',
			'class' =>	'form-required ltr',
			'value' =>	isset($model)? $model->slug : '',
			'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.english-only'),
		])

		@include('forms.group-start')

			@include('forms.button' , [
				'label' => trans('forms.button.save'),
				'shape' => 'success',
				'type' => 'submit' ,
			])
			@include('forms.button' , [
				'label' => trans('forms.button.cancel'),
				'shape' => 'link',
				'link' => '$(".modal").modal("hide")',
			])

		@include('forms.group-end')

		@include('forms.feed')

	</div>
@include('templates.modal.end')
