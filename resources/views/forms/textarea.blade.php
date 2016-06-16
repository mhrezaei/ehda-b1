
<div class="form-group">
    @if(isset($caption))
        <label class="control-label" for="{{ $name }}">{{ $caption }}...</label>
    @endif
    <textarea name="{{ $name }}" class="form-control {{ $class or '' }}" rows="{{ $rows or 5 }}" placeholder="{{$placeholder or ''}}" {{$extra or ''}}>{{$value or ''}}</textarea>
    <span class="help-block" >{{ $hint or '' }}</span>
</div>
