@include('templates.modal.start' , [
	'modal_id' => 'modalDomainCities' ,
	'modal_size' => 'lg',
	'form_url' => 'manage/devSettings/domains/save',
	'modal_title' => 'this',
])
	<label class="hidden _1">{{trans('manage.devSettings.domains.cities-of')}}</label>
	<label class="hidden _2">{email: 'brian@thirdroute.com', name: 'Brian Reavis'},{email: 'nikola@tesla.com', name: 'Nikola Tesla'},{email: 'someone@gmail.com'}</label>

	<div class='modal-body'>

		@include('forms.hidden' , [
			'name' => 'id' ,
			'value' => isset($model)? $model->id : '0',
		])

		@include('forms.input' , [
			'name' =>	'cities',
			'value' =>	'',
			'class' => 'form-required' ,
			'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
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
