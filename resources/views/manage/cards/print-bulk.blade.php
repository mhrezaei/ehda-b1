@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/cards/save/bulk_print'),
	'modal_title' => trans('forms.button.card_print'),
	'no-validation' => '1' ,
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['ids' , '' ],
	]])

	@include('forms.select' , [
		'name' => 'status' ,
		'value' =>  ''  ,
		'blank_value' => '' ,
		'options' => $print ,
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
<script>gridSelector('get')</script>