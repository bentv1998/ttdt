<div class="form-group row @error($name) validated @enderror">
    <label class="col-lg-2 col-form-label" for="{{ empty($id) ? $name : $id }}">{{ $label }}
        @if (isset($required) && $required) <span class="text-danger">*</span> @endif
    </label>
    <div class="col-lg-6 input-group date">
        <input type="text"
               class="form-control {{ $class ?? '' }} @error($name) is-invalid @enderror"
               placeholder="{{ $placeholder ?? __('ttdt.enter')." $label" }}"
               id="kt_datepicker_4_1"
               readonly
               name="{{ $name ?? '' }}"
               value="{{ $value ?? '' }}"
        />
        <div class="input-group-append">
			<span class="input-group-text">
			    <i class="flaticon2-calendar-9"></i>
			</span>
        </div>
        @if (isset($helpText)) <span class="form-text text-muted">{{ $helpText }}</span> @endif
        @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
@push('scripts')
    <script>
        let arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        };

        $('#kt_datepicker_4_1').datepicker({
            rtl: KTUtil.isRTL(),
            orientation: "top left",
            todayHighlight: true,
            templates: arrows,
            endDate: 'today'
        });
    </script>
@endpush
