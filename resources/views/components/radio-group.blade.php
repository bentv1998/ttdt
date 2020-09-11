<div class="form-group row @error(!$name) validated @enderror">
    <label class="col-lg-2 col-form-label" for="{{ $id ?? $name }}">
        {{ $label }} @if($required) <span class="text-danger">*</span> @endif
    </label>
    <div class="col-lg-6 col-form-label">
        <div class="@if($inline) radio-inline @else radio-list @endif">
            @foreach($options as $key => $text)
                <label class="radio">
                    <input name="{{ $name ?? '' }}"
                           type="radio" value="{{ $key }}"
                           {{ isset($value) && $key == $value ? 'checked' : '' }} /> @lang($text)
                    <span></span>
                </label>
            @endforeach
        </div>
        @if (isset($helpText)) <span class="form-text text-muted">{{ $helpText }}</span> @endif

        @error($name)
        <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>

