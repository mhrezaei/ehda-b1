@include('forms.opener' , [
	'id' => 'frmInquiry',
	'url' => 'manage/volunteers/save/inquiry',
	'title' => trans('people.volunteers.manage.create') ,
	'class' => 'js' ,
])

	@include('forms.input' , [
		'id' => 'txtInquiry' ,
		'name' => 'code_melli',
		'value' =>  $model->code_melli ,
		'class' => 'form-required  form-default',
	])

	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('forms.button.Inquiry'),
			'shape' => 'primary',
			'type' => 'submit' ,
		])

	@include('forms.group-end')

	@include('forms.feed' , [])


@include('forms.closer')
