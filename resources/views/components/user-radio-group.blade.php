<div class="form-group row" id="{{ $id ?? '' }}">
    <div class="col-12">
        <label class="font-weight-bolder">{{ $label }}
            @if (isset($required) && $required) <span class="text-danger">*</span> @endif
        </label>
        <div class="@if($inline) radio-inline @else radio-list @endif {{ $class ?? '' }}">
            @foreach($options as $key => $text)
                <label class="radio">
                    <input name="{{ $name ?? '' }}"
                           type="radio" value="{{ $key }}"
                        @if(isset($value) && $key == $value) checked @endif /> @lang($text)
                    <span></span>
                </label>
            @endforeach
        </div>
        @if (isset($helpText)) <span class="form-text text-muted">{{ $helpText }}</span> @endif
        @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
