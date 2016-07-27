@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/volunteers/save/bulk_email'),
	'modal_title' => trans('people.commands.send_email'),
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

	@include('forms.input' , [
		'name' => 'title',
		'label' => trans('validation.attributes.title'),
		'class' => 'atl form-required',
	])

	@include('forms.textarea' , [
		'name' => 'message',
		'label' => trans('validation.attributes.message'),
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