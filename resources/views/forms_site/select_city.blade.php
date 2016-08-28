<?php
if(isset($class) && str_contains($class, 'form-required')) {
	$required = true;
}
?>
<style>
	.dropdown-menu, .filter-option{
		text-align: right !important;
	}
</style>
<div class="form-group">
	<label
			for="{{$field}}"
			class="{{$label_class or ''}}"
	>
		{{$label or trans("validation.attributes.$field")}}
		@if(isset($required))
			<span class="text-danger">*</span>
		@endif
	</label>

		<select
				id="{{$field or ''}}"
				name="{{$field or ''}}" value="{{$value or ''}}"
				class="form-control selectpicker {{$class or ''}}"
				placeholder="{{$placeholder or ''}}"
				data-size= "{{$size or 5}}"
				data-live-search = "{{$search or false}}"
				data-live-search-placeholder= "{{$search_placeholder or trans('forms.button.search')}}..."
				{{$extra or ''}}
				error-value="{{ trans('validation.javascript_validation.' . $field) }}"
				{{ $att or '' }}
		>
			@if(isset($blank_value) and $blank_value!='NO')
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