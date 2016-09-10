@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/volunteers/save/care_review'),
	'modal_title' => trans('people.volunteers.manage.care_review'),
	'no_validation' => 1
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]])

	@include('manage.account.profile-inside' , ['show_unchanged' => false])

	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('people.volunteers.manage.care_save'),
			'shape' => 'success',
			'type' => 'submit' ,
			'value' => 'save' ,
		])

		@include('forms.button' , [
			'label' => trans('forms.button.cancel'),
			'shape' => 'link',
			'link' => '$(".modal").modal("hide")',
		])

	@include('forms.group-end')

	@include('forms.sep')

	@include('forms.input' , [
		'name' => 'reject_reason',
		'value' => null ,
		'class' => 'form-required' ,
	])

	@include('forms.group-start')


		@include('forms.button' , [
			'label' => trans('people.volunteers.manage.care_reject'),
			'shape' => 'danger',
			'type' => 'submit' ,
			'value' => 'reject' ,
		])

	@include('forms.group-end')

	@include('forms.feed')

</div>

@include('templates.modal.end')