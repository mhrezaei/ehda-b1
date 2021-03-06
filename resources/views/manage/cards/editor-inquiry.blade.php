@include('forms.opener' , [
	'id' => 'frmInquiry',
	'url' => 'manage/cards/save/inquiry',
	'title' => $model->id? trans('people.cards.manage.edit').' '.$model->fullName() : trans('people.cards.manage.create') ,
	'class' => 'js' ,
	'no_validation' => 1 ,
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
