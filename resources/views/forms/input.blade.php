<div class="form-group">
    @if(isset($caption))
        <label class="control-label" for="{{ $name }}">{{ $caption }}...</label>
    @endif
    <input name="{{ $name }}" type="{{ $type or "text" }}" class="form-control {{ $class or '' }}" value="{{ $value or '' }}" placeholder="{{$placeholder or ''}}" {{$extra or ''}}>
    <span class="help-block" >{{ $hint or '' }}</span>
</div>
