<div class="form-group row @error($name) validated @enderror">
        <label class="col-lg-2 col-form-label" for="{{ $id ?? $name }}">
                {{ $label }} @if($required) <span class="text-danger">*</span> @endif
        </label>
        <div class="col-lg-6">
                <select id="{{ $id ?? $name }}" name="{{ $name ?? '' }}" @if($disabled) disabled @endif class="form-control {{ $class ?? '' }} @error($name) is-invalid @enderror">
                        <option value="">{{ $placeholder }}</option>
                        @foreach($options as $key => $text)
                        <option value="{{ $key }}" {{ isset($value) && $key == $value ? 'selected' : '' }}> @lang($text)</option>
                        @endforeach
                </select>
            @if (isset($helpText)) <span class="form-text text-muted">{{ $helpText }}</span> @endif
            @error($name)
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>

</div>
