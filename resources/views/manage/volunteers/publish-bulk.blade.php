@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/volunteers/save/bulk_publish'),
	'modal_title' => trans('people.commands.publish'),
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['ids' , null ],
	]])

	@include('forms.input' , [
		'name' => '',
		'id' => 'txtCount' ,
		'label' => trans('validation.attributes.items'),
		'extra' => 'disabled' ,
	])

	@include('forms.group-start')
		@include('forms.note' , [
			'text' => trans('people.form.will-be-notified') ,
			'shape' => 'info' ,
		])

		@include('forms.button' , [
			'label' => trans('people.commands.publish'),
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
<script>gridSelector('get')</script>