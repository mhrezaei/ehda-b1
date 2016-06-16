<div class="checkbox">
    <label>
        <input name="{{ $name }}" type="checkbox" {{isset($value)&&$value?'checked':''}} class="checkbox {{ $class or '' }}" title="{{ $title or '' }}" {{$extra or ''}}>
        {{ $caption }}
    </label>
</div>
