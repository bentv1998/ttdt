<div class="form-group row @error($name) validated @enderror">
    <label class="col-lg-2 col-form-label" for="{{ $id ?? $name }}">
        {{ $label }} @if($required) <span class="text-danger">*</span> @endif
    </label>
    <div class="col-lg-6">
        <select id="{{ $id ?? $name }}" name="{{ $name ? $name."[]" : '' }}"
                class="form-control kt-select2 {{ $class ?? '' }}" multiple
                data-placeholder="{{ $placeholder ?? __('ttdt.choose')." $label" }}">
            @foreach($options as $key => $text)
                @php
                    $isSelected = !empty($value) && in_array($key, $value)
                @endphp
                @if($name == 'transactions[]')
                    {{ $value }}
                @endif
                <option value="{{ $key }}" {{ $isSelected ? 'selected' : '' }}> {{ $text }} </option>
            @endforeach
        </select>
        @error($name)
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>

</div>
