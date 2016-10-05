@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => 'manage/devSettings/domains/save',
	'modal_title' => $model->id? trans('manage.devSettings.domains.edit') : trans('manage.devSettings.domains.add'),
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]])

	@include('forms.input' , [
		'name' =>	'title',
		'value' =>	$model->title ,
		'class' => 'form-required form-default' ,
		'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.persian-only'),
	])

	@include('forms.input' , [
		'name' =>	'slug',
		'class' =>	'form-required ltr',
		'value' =>	$model->slug ,
		'hint' =>	trans('validation.hint.unique').' | '.trans('validation.hint.english-only'),
	])
	@include('forms.input' , [
		'name' =>	'alias',
		'class' =>	'ltr',
		'value' =>	$model->alias ,
		'hint' =>	trans('manage.devSettings.domains.alias_hint'),
	])

	@include('forms.note' , [
		'fake' => $city_count = $model->states()->count() ,
		'shape' => $city_count? 'warning' : 'danger' ,
		'text' => $city_count? trans('manage.devSettings.domains.domain_cant_delete_alert' , ['count' => $city_count]) : trans('manage.devSettings.states.city_delete_alert') ,
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
			'extra' => $city_count? 'disabled' : ''
		])

	@endif


	@include('forms.button' , [
		'label' => trans('forms.button.cancel'),
		'shape' => 'link',
		'link' => '$(".modal").modal("hide")',
	])

	@include('forms.group-end')

	@include('forms.feed')

</div>
@include('templates.modal.end')