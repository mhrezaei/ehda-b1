<?php
if(isset($class) && str_contains($class, 'form-required')) {
	$required = true;
}
?>

<div class="form-group">
	<label
			for="{{$name}}"
			class="col-sm-2 control-label {{$label_class or ''}}"
	>
		{{$label or trans("validation.attributes.$name")}}
		@if(isset($required) and $required)
			<span class="fa fa-star required-sign " title="{{trans('forms.logic.required')}}"></span>
		@endif
	</label>

	<div class="col-sm-10">
		@include('forms.select_self')
		<span class="help-block {{$hint_class or ''}}">
			{{ $hint or '' }}
		</span>

	</div>
</div>