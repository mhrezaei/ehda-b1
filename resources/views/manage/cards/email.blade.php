@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/volunteers/save/email'),
	'modal_title' => trans('people.commands.send_email'),
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]])


	@include('forms.input' , [
		'name' => '',
		'label' => trans('validation.attributes.name_first'),
		'value' => $model->fullName() ,
		'extra' => 'disabled' ,
	])

	@include('forms.input' , [
	    'name' => 'title',
	    'label' => trans('validation.attributes.title'),
	    'class' => 'atl form-required form-default',
	])

	@include('forms.textarea' , [
		'name' => 'message',
		'label' => trans('validation.attributes.message'),
	    'class' => 'form-required',
	])

	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('people.commands.send_email'),
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