<?php
if(isset($class)) {
	if(str_contains($class, 'form-required')) {
		$required = true;
	}
}
?>

<div class="form-group">
	<label
			for="{{$name}}"
			class="col-sm-2 control-label {{$label_class or ''}}"
	>
		{{$label or Lang::has("validation.attributes.$name") ? trans("validation.attributes.$name") : $name}}
		@if(isset($required) and $required)
			<span class="fa fa-star required-sign " title="{{trans('forms.logic.required')}}"></span>
		@endif
	</label>

	<div class="col-sm-10">
		<input
				type="{{$type or 'text'}}"
				id="{{$id or ''}}"
				name="{{$name}}" value="{{$value or ''}}"
				class="form-control {{$class or ''}}"
				placeholder="{{$placeholder or ''}}"
				{{$extra or ''}}
		>
		<span class="help-block">
			{{ $hint or '' }}
		</span>
	</div>
</div>