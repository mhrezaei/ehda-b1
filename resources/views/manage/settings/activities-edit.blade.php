@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/devSettings/activities/save'),
	'modal_title' => $model->id? trans('manage.devSettings.activities.edit') : trans('manage.devSettings.activities.new'),
])
	<div class='modal-body'>

		@include('forms.hidden' , [
			'name' => 'id' ,
			'value' => $model->id,
		])

		@include('forms.input' , [
			'name' =>	'title',
			'value' =>	$model->title,
			'class' => 'form-required form-default' ,
			'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
		])


		@include('forms.input' , [
			'name' =>	'slug',
			'class' =>	'form-required ltr',
			'value' =>	$model->slug ,
			'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.english-only'),
		])

		@include('forms.textarea' , [
		    'name' => 'text',
		    'value' => $model->text,
		])

		@include('forms.note' , [
			'shape' => 'danger' ,
			'text' => trans('manage.devSettings.activities.delete_alert' ) ,
			'class' => '-delHandle noDisplay'
		])

		@include('forms.group-start')

			@include('forms.button' , [
				'id' => 'btnSave' ,
				'label' => trans('forms.button.save'),
				'shape' => 'success',
				'type' => 'submit' ,
				'value' => 'save' ,
				'class' => '-delHandle'
			])

			@if($model->id)
				@include('forms.button' , [
					'id' => 'btnDeleteWarning' ,
					'label' => trans('forms.button.delete'),
					'shape' => 'warning',
					'link' => '$(".-delHandle").toggle()' ,
					'class' => '-delHandle' ,
				])
				@include('forms.button' , [
					'id' => 'btnDelete' ,
					'label' => trans('forms.button.sure_hard_delete'),
					'shape' => 'danger',
					'value' => 'delete' ,
					'type' => 'submit' ,
					'class' => 'noDisplay -delHandle' ,
				])

			@endif


			@include('forms.button' , [
				'label' => trans('forms.button.cancel'),
				'shape' => 'link',
				'link' => '$(".modal").modal("hide")',
			])

		@include('forms.group-end')

		@include('forms.feed')

		@include('forms.closer')

	</div>
@include('templates.modal.end')