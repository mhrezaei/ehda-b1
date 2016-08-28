<div class="form-group">
    <label for="{{ $field or '' }}">{{ trans('validation.attributes.' . $field) }}:
    @if(isset($required))
            <span class="text-danger">*</span>
    @endif
    </label>
    <input
            type="{{ $type or 'text' }}"
            class="form-control {{ $class or '' }}"
            id="{{ $field or '' }}"
            name="{{ $field or '' }}"
            data-toggle="tooltip"
            data-placement="top"
            placeholder="{{ trans('validation.attributes_placeholder.' . $field)}}"
            title="{{ trans('validation.attributes_example.' . $field)}}"
            minlength="{{ $min or '' }}"
            maxlength="{{ $max or '' }}"
            value="{{ $value or '' }}"
            error-value="{{ trans('validation.javascript_validation.' . $field) }}"
            {{ $attr or '' }}
    >
</div>