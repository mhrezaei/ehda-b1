@foreach($model->branch()->allowedMeta() as $key => $type)
	@if($type=='textarea')
		@include('forms.textarea' , [
			'name' => $key,
			'value' => $model->meta($key) ,
			'rows' => 2,
		])
	@elseif($type=='date')
		@include('forms.datepicker' , [
			'name' => $key,
			'value' => $model->meta($key),
			'type' => '' ,
		])
	@else
		@include('forms.input' , [
			'name' => $key,
			'value' => $model->meta($key),
		])

	@endif
@endforeach
