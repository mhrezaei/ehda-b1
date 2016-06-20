<div class="input-group">
	<span class="input-group-addon">
		<i class="material-icons">{{ $icon or '' }}</i>
	</span>
{{--	{!! Form::text($name, '' , [--}}
		{{--'class' => 'form-control',--}}
		{{--'placeholder' => $cap,--}}
	{{--]) !!}--}}
{{----}}
	<input type="{{$type or 'text'}}" name="{{$name or ''}}" class="form-control" placeholder="{{ $cap or '' }}">
</div>
