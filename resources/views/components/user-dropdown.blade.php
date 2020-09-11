<div class="form-group row @error($name) validated @enderror">
    <div class="col-12">
        @if($label ?? false)
        <label for="">
            {{ $label }} @if($required) <span class="text-danger">*</span> @endif
        </label>
        @endif
        <select id="{{ $id ?? $name }}" name="{{ $name ?? '' }}" @if($disabled) disabled @endif class="form-control {{ $class ?? '' }} @error($name) is-invalid @enderror">
            @if($placeholder) <option value="">{{ $placeholder }}</option> @endif
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
