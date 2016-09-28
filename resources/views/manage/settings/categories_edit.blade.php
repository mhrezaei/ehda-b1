@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/devSettings/categories/save'),
	'modal_title' => $model->id? trans('manage.devSettings.categories.edit') : trans('manage.devSettings.categories.new'),
])
<div class='modal-body'>

	@include('forms.hidden' , [
		'name' => 'id' ,
		'value' => $model->id,
	])

	@include('forms.select' , [
		'name' => 'branch_id' ,
		'class' => 'form-required',
		'options' => $branches->get() ,
		'caption_field' => 'plural_title' ,
		'value' => $model->branch_id
	])

	@include('forms.input' , [
	    'name' =>	'title',
	    'value' =>	$model->title,
	    'class' => 'form-required form-default' ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
	])

	@include('forms.input' , [
	    'name' =>	'slug',
	    'class' =>	'form-required ltr',
		'value' =>	$model->slug ,
	    'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.english-only'),
	])

	@include('forms.group-start')

		@include('manage.settings.categories_edit_image')

	@include('forms.group-end')

	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('forms.button.save'),
			'shape' => 'success',
			'type' => 'submit' ,
		])
		@include('forms.button' , [
			'label' => trans('forms.button.cancel'),
			'shape' => 'link',
			'link' => '$(".modal").modal("hide")'
		])

	@include('forms.group-end')

	@include('forms.feed')

	@include('forms.closer')

</div>
@include('templates.modal.end')