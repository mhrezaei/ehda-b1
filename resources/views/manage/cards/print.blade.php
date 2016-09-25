@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/cards/save/print'),
	'modal_title' => trans('forms.button.card_print'),
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

	@include('forms.select' , [
		'name' => 'status' ,
		'value' =>  $model->card_print_status  ,
		'blank_value' => '' ,
		'options' => $opt['print'] ,
		'value_field' => '0' ,
		'caption_field' => '1' ,
		'size' => 10 ,
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