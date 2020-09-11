<div class="form-group row @error($name) validated @enderror">
    <label class="col-lg-2 col-form-label" for="{{ empty($id) ? $name : $id }}">{{ $label }}
        @if (isset($required) && $required) <span class="text-danger">*</span> @endif
    </label>
    <div class="col-lg-6">
        <input id="{{ empty($id) ? $name : $id }}" name="{{ $name ?? '' }}" type="{{ $type ?? 'text' }}"
               class="form-control {{ $class ?? '' }} @error($name) is-invalid @enderror"
               @if($readOnly) readOnly @endif
               @if($disabled) disabled @endif
               placeholder="{{ $placeholder ?? __('ttdt.enter')." $label" }}"
               value="{{ $type !== 'password' ? $value : '' }}">
        @if (isset($helpText)) <span class="form-text text-muted">{{ $helpText }}</span> @endif
        @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
