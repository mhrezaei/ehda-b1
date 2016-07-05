<div class="checkbox">
    <label>
        <input
				id="{{$id or ''}}"
                name="{{ $name }}"
                type="checkbox" {{isset($value)&&$value?'checked':''}}
                class="checkbox {{ $class or '' }}"
                title="{{ $title or '' }}"
                {{$extra or ''}}
        >
        {{ $label or trans("validation.attributes.$name") }}
    </label>
</div>
