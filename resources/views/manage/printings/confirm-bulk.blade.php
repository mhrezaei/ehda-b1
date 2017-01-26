@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/cards/save/printings/bulk_confirm'),
	'modal_title' => trans('people.commands.confirm_good_print'),
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

	@include("forms.note" , [
		'text' => trans('people.commands.confirm_good_print_hint'),
	])

	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('people.commands.confirm_good_print'),
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
<script>gridSelector('get');</script>