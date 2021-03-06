@foreach($model->branch()->allowedMeta() as $field)
	@if($field['type']=='textarea')
		@include('forms.textarea' , [
			'name' => $field['name'],
			'value' => $model->meta($field['name']) ,
			'rows' => 3,
			'class' => $field['required']? 'form-required' : ''
		])
	@elseif($field['type']=='date')
		@include('forms.datepicker' , [
			'name' => $field['name'],
			'value' => $model->meta($field['name']),
			'type' => '' ,
			'class' => $field['required']? 'form-required' : ''
	])
	@elseif($field['type']=='boolean')
		@include("manage.settings.downstream-value-boolean" , [
			'name' => $field['name'],
			'value' => $model->meta($field['name']),
			'label' => trans('validation.attributes.'.$field['name']),
		])
	@else
		@include('forms.input' , [
			'name' => $field['name'],
			'value' => $model->meta($field['name']),
			'class' => $field['required']? 'form-required' : ''
		])
	@endif
@endforeach
