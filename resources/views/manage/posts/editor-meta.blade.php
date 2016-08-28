@foreach($allowed_meta as $key => $type)
	@if($type=='area')
		@include('forms.textarea' , [
			'name' => $key,
			'value' => $model->meta($key) ,
			'rows' => 2,
		])
	@else
		@include('forms.input' , [
			'name' => $key,
			'value' => $model->meta($key),
		])

	@endif
@endforeach
