<div class="{{ $colClass ?? '' }} kt-margin-b-20-tablet-and-mobile">
    <div class="kt-form__group kt-form__group--inline">
        <div class="kt-form__label">
            <label>{{ $label ?? '' }}</label>
        </div>
        <div class="kt-form__control">
            <select class="form-control m-bootstrap-select {{ $class ?? '' }}" id="{{ $id }}" name="{{ $name }}">
                <option value="">{{ $placeholder ?? __('mc.all') }} </option>
                @foreach ($options as $id => $name)
                    <option value="{{ $id }}">{{ __($name) }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
