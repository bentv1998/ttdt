<div class="container">
    <form class="card card-custom"
          id="kt_page_sticky_card" method="POST"
          action="{{ route($modelRoute, $model) }}">

        @method($method ?? 'POST')
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
            <div class="header-description">{{ $description ?? '' }}</div>
        </div>
        <div class="card-body">
            <!--begin::Form-->
            <div id="kt_form" class="form">
                @csrf
                <div class="row">
                    <div class="@if($slot != '') col-lg-9 @else col-12 @endif">
                        <div class="my-5">
                            @foreach($fields as $key => $field)
                                @switch($field['type'])
                                    @case('title')
                                    <div class="form-group">
                                        <div>
                                            @if(!($field['no_line'] ?? false))
                                                <hr class="border-1 my-10">@endif
                                            <h6 class="text-dark {{ $field['class'] ?? '' }}"
                                                style="{{ $field['style'] ?? '' }}">{!! $field['label']  !!}</h6>
                                            <p class="form-text mb-5">{!! $field['help_text'] ?? '' !!}</p>
                                        </div>
                                    </div>
                                    @break

                                    @case('check-list')
                                    <x-check-list :name="$field['name']" :options="$field['options']"
                                                  :label="$field['label']"
                                                  :inline="$field['inline'] ?? true"
                                                  :required="$field['required'] ?? false"
                                                  :id="$field['id'] ?? ''"
                                                  :value="old($field['name'], $field['value'] ?? ($model->{$field['name']} ?? ''))"
                                                  :helpText="$field['help_text'] ?? ''"
                                                  :class="$field['class'] ?? null"/>
                                    @break

                                    @case('element')
                                    {{ ${$field['name']} ?? '' }}
                                    @break

                                    @case('select')
                                    <x-user-dropdown :name="$field['name']" :options="$field['options']"
                                                     :label="$field['label']"
                                                     :id="$field['id'] ?? $field['name']"
                                                     :placeholder="$field['placeholder'] ?? ''"
                                                     :required="$field['required'] ?? false"
                                                     :value="old($field['name'], $field['value'] ?? ($model->{$field['name']} ?? ''))"
                                                     :helpText="$field['help_text'] ?? ''"
                                                     :disabled="$field['disabled'] ?? false"
                                                     :class="$field['class'] ?? null"/>
                                    @break

                                    @case('select_multiple')
                                    <x-dropdown-multiple :name="$field['name']" :options="$field['options']"
                                                         :label="$field['label']"
                                                         :placeholder="$field['placeholder']"
                                                         :required="$field['required'] ?? false"
                                                         :value="old($field['name'], isset($model->{$field['name']}) ? $model->{$field['name']}->pluck('id')->toArray() : '')"
                                                         :class="$field['class'] ?? null"/>
                                    @break

                                    @case('datepicker')
                                    <x-user-datepicker :label="$field['label']" :name="$field['name']"
                                                       :placeholder="$field['placeholder']"
                                                       :required="$field['required'] ?? false"
                                                       :value="old($field['name'], $field['value'] ?? ($model->{$field['name']} ?? ''))"
                                                       :helpText="$field['help_text'] ?? ''"
                                                       :class="$field['class'] ?? ''"/>
                                    @break

                                    @case('radio_group')
                                    <x-user-radio-group :name="$field['name']" :options="$field['options']"
                                                        :label="$field['label']"
                                                        :inline="$field['inline'] ?? true"
                                                        :required="$field['required'] ?? false"
                                                        :id="$field['id'] ?? ''"
                                                        :value="old($field['name'], $field['value'] ?? ($model->{$field['name']} ?? ''))"
                                                        :helpText="$field['help_text'] ?? ''"
                                                        :class="$field['class'] ?? null"/>
                                    @break

                                    @case('textarea')
                                    <x-user-text-area :label="$field['label']" :name="$field['name']"
                                                      :placeholder="$field['placeholder'] ?? ''"
                                                      :required="$field['required'] ?? false"
                                                      :readOnly="$field['readonly'] ?? false"
                                                      :disabled="$field['disabled'] ?? false"
                                                      :value="old($field['name'], $field['value'] ?? ($model->{$field['name']} ?? ''))"
                                                      :helpText="$field['help_text'] ?? ''"
                                                      :class="$field['class'] ?? ''"/>
                                    @break

                                    @case('hidden')
                                    <input name="{{ $field['name'] }}" type="hidden"
                                           value="{{ old($field['name'], $field['value'] ?? ($model->{$field['name']} ?? '')) }}"/>
                                    @break

                                    @case('text')
                                    @case('password')
                                    @case('email')
                                    @default
                                    <x-user-text-field :label="$field['label']" :name="$field['name']"
                                                       :type="$field['type']"
                                                       :placeholder="$field['placeholder']"
                                                       :required="$field['required'] ?? false"
                                                       :readOnly="$field['readonly'] ?? false"
                                                       :disabled="$field['disabled'] ?? false"
                                                       :value="old($field['name'], $field['value'] ?? ($model->{$field['name']} ?? ''))"
                                                       :helpText="$field['help_text'] ?? ''"
                                                       :class="$field['class'] ?? ''"/>
                                @endswitch
                            @endforeach
                        </div>
                    </div>
                    @if($slot != '')
                        <div class="col-lg-3">
                            {!! $slot !!}
                        </div>
                    @endif
                    <div class="kt-portlet__foot" id="element-to-hide" data-html2canvas-ignore="true">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-toolbar text-left">
                                        <button type="reset" class="btn btn-secondary mr-2">Reset</button>
                                        <button type="submit"
                                                class="btn btn-primary">{{ __('Save') }}</button>
                                        {{ $button ?? '' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Form-->
            </div>

            {{ $attach ?? '' }}
        </div>
    </form>
</div>

@push('css')
    <style>
        .form-group {
            margin-bottom: 1rem;
        }

        .width-fit-content {
            width: fit-content;
        }

        .card.card-custom > .card-header {
            padding-top: 25px !important;
            padding-bottom: 25px !important;
        }

        .faqs .row {
            margin-top: 15px;
        }
    </style>
@endpush
