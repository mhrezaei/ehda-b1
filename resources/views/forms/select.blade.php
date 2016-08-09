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
				class="form-control selectpicker {{$class or ''}}"
				placeholder="{{$placeholder or ''}}"
				data-size= "{{$size or 5}}"
				data-live-search = "{{$search or false}}"
				data-live-search-placeholder= "{{$search_placeholder or trans('forms.button.search')}}..."
				{{$extra or ''}}
		>
			@if(isset($blank_value) and $blank_value!='NO')
				<option value="{{$blank_value}}"
						@if(!isset($value) or $value==$blank_value)
							selected
						@endif
				>{{ $blank_label or '' }}</option>
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