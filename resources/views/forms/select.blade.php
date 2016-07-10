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
		<select
				id="{{$id or ''}}"
				name="{{$name}}" value="{{$value or ''}}"
				class="form-control {{$class or ''}}"
				placeholder="{{$placeholder or ''}}"
				{{$extra or ''}}
		>
			@if(isset($blank_value))
				<option value="{{$blank_value}}"
						@if(!isset($value) or $value==$blank_value)
							selected
						@endif
				></option>
			@endif
			@foreach($options as $option)
				<option value="{{$option['id']}}"
						@if(isset($value) and $value==$option['id'])
							selected
						@endif
				>
					{{$option['title']}}</option>
			@endforeach
		</select>
		<span class="help-block">
			{{ $hint or '' }}
		</span>

	</div>
</div>