@extends('manage.frame.use.0')

@section('section')

	@include('forms.opener' , [
		'id' => 'frmEditor',
		'url' => 'manage/cards/save/volunteers',
		'title' => $model->isCard()? trans('people.cards.manage.edit').' '.$model->fullName() : trans('people.cards.manage.create') ,
		'class' => 'js' ,
		'no_validation' => 1 ,
	])

		@include('forms.hiddens' , ['fields' => [
			['id' , $model->id],
		]])

		@include('forms.input' , [
			'name' => 'code_melli',
			'value' =>  $model->code_melli ,
			'extra' => 'disabled' ,
		])

		@include('forms.input' , [
			'name' => 'name_first',
			'value' =>$model->fullName() ,
			'extra' => 'disabled' ,
		])

		@include('forms.group-start' , [
			'required' => true ,
			'label' => trans('validation.attributes.organs')
		])

			@include('manage.cards.editor-organs' , [
				'organs' => $model::$donatable_organs ,
			])

		@include('forms.group-end')

		@include('forms.sep')

		@include('forms.group-start')

			@include('forms.button' , [
				'label' => trans('forms.button.save'),
				'shape' => 'success',
				'type' => 'submit' ,
			])

			@include('forms.button' , [
				'label' => trans('people.cards.manage.save_and_send_to_print'),
				'value' => 'print' ,
				'shape' => 'primary',
				'type' => 'submit' ,
			])

		@include('forms.group-end')

		@include('forms.feed' , [])

	@include('forms.closer')

@endsection
