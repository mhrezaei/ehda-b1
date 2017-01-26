@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/cards/save/printings/bulk_excel'),
	'modal_title' => trans('people.commands.export_to_excel'),
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['ids' , '' ],
		['browse_event_id' , '0' ],
	]])


	@include('forms.input' , [
		'name' => '',
		'id' => 'txtCount' ,
		'label' => trans('validation.attributes.items'),
		'extra' => 'disabled' ,
	])

	@include("forms.group-start" , [
		'' => "",
	])
	@include("forms.check" , [
		'name' => "select_all",
		'label' => trans('people.commands.select_all_from_pendings'),
		'value' => false,
	])
	@include("forms.group-end" , [
		'' => "",
	])

	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('people.commands.export_to_excel'),
			'shape' => 'primary',
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
<script>gridSelector('get');$('[name=browse_event_id]').val( $('#txtEventId').val() );</script>