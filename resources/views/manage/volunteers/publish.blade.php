@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/volunteers/save/publish'),
	'modal_title' => trans('people.commands.publish'),
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

	@include('forms.group-start')
		@include('forms.note' , [
			'text' => trans('people.form.will-be-notified') ,
			'shape' => 'info' ,
		])


		@include('forms.button' , [
			'label' => trans('people.commands.publish'),
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