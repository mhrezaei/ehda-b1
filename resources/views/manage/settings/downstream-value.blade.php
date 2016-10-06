@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/devSettings/downstream/set'),
	'modal_title' => $model->title ,
])
	<div class='modal-body'>

		@include('forms.hiddens' , ['fields' => [
			['id' , $model->id],
			['data_type' , $model->data_type]
		]])

		@include('forms.input' , [
			'name' =>	'title',
			'value' =>	$model->title." ($model->slug) ",
			'extra' => 'disabled'
		])

		@include("manage.settings.downstream-value-$model->data_type" , [
			'value' => $model->global_value ,
		])

		@foreach($model->domains() as $domain)
			@include("manage.settings.downstream-value-$model->data_type" , [
				'value' => $model->value($domain->slug) ,
			])
		@endforeach

		@include('forms.group-start')

			@include('forms.button' , [
				'id' => 'btnSave' ,
				'label' => trans('forms.button.save'),
				'shape' => 'success',
				'type' => 'submit' ,
				'value' => 'save' ,
			])

			@include('forms.button' , [
				'label' => trans('forms.button.cancel'),
				'shape' => 'link',
				'link' => '$(".modal").modal("hide")'
			])


		@include('forms.group-end')

		@include('forms.feed')

		@include('forms.closer')

	</div>
@include('templates.modal.end')