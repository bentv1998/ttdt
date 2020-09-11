<div class="row  mb-0 border-top border-top-light-dark-75 {{ $class ?? '' }} py-5 form-group row @error($name) validated @enderror"
     style="{{ $style ?? '' }}">
    <div class="col-lg-9">
        <h6>@lang($label)</h6>
        <p>@lang($helpText ?? '')</p>
        @error($name)
        <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
        @enderror
    </div>
    <div class="col-lg-3">
        <div class="radio-inline">
            @foreach($options as $key => $text)
                <label class="radio ">
                    <input name="{{ $name ?? '' }}"
                           type="radio" value="{{ $key }}"
                        {{ isset($value) && $key == $value ? 'checked' : '' }}/> @lang($text)
                    <span></span>
                </label>
            @endforeach
        </div>
    </div>
</div>
