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

	@include('forms.input' , [
		'name' => '',
		'id' => 'txtCount' ,
		'label' => trans('validation.attributes.items'),
		'extra' => 'disabled' ,
	])

	@include("forms.select" , [
		'name' => "event_id",
		'value' => $preferred_event_id,
		'blank_value' => "",
		'blank_label' => " ",
		'options' => $events,
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
<script>gridSelector('get')</script>