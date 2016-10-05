<div class="form-group">
    <label for="{{ $field or '' }}">{{ trans('validation.attributes.' . $field) }}:
        @if(isset($required))
            <span class="text-danger">*</span>
        @endif
    </label>
    <select
            class="form-control  {{ $class or '' }}"
            id="{{ $field or '' }}"
            name="{{ $field or '' }}"
            data-toggle="tooltip"
            data-placement="top"
            title="{{ trans('validation.attributes_example.' . $field) }}"
            value="{{ $value or '' }}"
            error-value="{{ trans('validation.javascript_validation.' . $field) }}"
            {{ $att or '' }}>
        <option value="0">{{ trans('forms.general.select_default') }}</option>
        <option value="1"
                @if(isset($value) and 1 == $value)
                selected="selected"
                @endif
        >{{ trans('people.marital.1') }}</option>
        <option value="1"
                @if(isset($value) and 2 == $value)
                selected="selected"
                @endif
        >{{ trans('people.marital.2') }}</option>

    </select>
</div>