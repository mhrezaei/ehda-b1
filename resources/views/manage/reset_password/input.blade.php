<div class="input-group">
	<span class="input-group-addon">
		<i class="material-icons">{{ $icon or '' }}</i>
	</span>
	<input type="{{$type or 'text'}}" name="{{$name or ''}}" class="form-control {{$class or ''}}" placeholder="{{ $cap or '' }}">
</div>
