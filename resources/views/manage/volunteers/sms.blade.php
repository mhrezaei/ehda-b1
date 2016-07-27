@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/volunteers/save/sms'),
	'modal_title' => trans('people.commands.send_sms'),
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
		['title','sms'],
	]])


	@include('forms.input' , [
		'name' => '',
		'label' => trans('validation.attributes.name_first'),
		'value' => $model->fullName() ,
		'extra' => 'disabled' ,
	])

	@include('forms.textarea' , [
		'name' => 'message',
		'label' => trans('validation.attributes.message'),
	])


	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('people.commands.send_sms'),
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