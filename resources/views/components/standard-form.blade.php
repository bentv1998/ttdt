<div class="container-fluid">
    <form class="card card-custom"
          id="kt_page_sticky_card" method="POST"
          action="{{ $mode === 'update' && isset($model) ?
			route($updateRoute, $model) :
			route($storeRoute, $model) }}">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? ($mode === 'update' ? __('Update') : __('Create')) }}
                @if ($mode === 'update' && isset($model))
                    <small class="pl-4"> {{ $title }} ID #: {{ $model->id }} | Created at: {{ $model->created_at }} |
                        Updated
                        at: {{ $model->updated_at }}</small>
                @endif
            </h3>
        </div>
        <div class="card-body">
            <!--begin::Form-->
            <div id="kt_form" class="form">
                @if ($mode === 'update')
                    @method('PUT')
                @endif
                @csrf
                <div class="col-12">
                    <div class="my-5">
                        @if(($model->code ?? false) && $mode === 'update')
                            <div class="form-group row">
                                <div class="col-lg-2">
                                    @lang('ttdt.list.code')
                                </div>
                                <div class="col-lg-6">
                                    {{ $model->code }}
                                </div>
                            </div>
                        @endif
                        @foreach($fields as $key => $field)
                            @switch($field['type'])
                                @case('title')
                                <div class="form-group">
                                    <div>
                                        @if(!($field['no_line'] ?? false))
                                            <hr class="border-1 my-10">
                                        @endif
                                        <h6 class="text-dark {{ $field['class'] ?? '' }}">{{ $field['label'] }}</h6>
                                        <p class="form-text mb-10">{{ $field['help_text'] ?? '' }}</p>
                                    </div>
                                </div>
                                @break

                                @case('element')
                                    {{ ${$field['name']} ?? '' }}
                                @break

                                @case('textarea')
                                <x-text-area :label="$field['label']" :name="$field['name']"
                                                  :placeholder="$field['placeholder'] ?? ''"
                                                  :required="$field['required'] ?? false"
                                                  :readOnly="$field['readonly'] ?? false"
                                                  :disabled="$field['disabled'] ?? false"
                                                  :value="old($field['name'], $field['value'] ?? ($model->{$field['name']} ?? ''))"
                                                  :helpText="$field['help_text'] ?? ''"
                                                  :class="$field['class'] ?? ''"/>
                                @break

                                @case('select')
                                <x-dropdown :name="$field['name']" :options="$field['options']" :label="$field['label']"
                                            :placeholder="$field['placeholder'] ?? ''"
                                            :required="$field['required'] ?? false"
                                            :value="old($field['name'], $field['value'] ?? ($model->{$field['name']} ?? ''))"
                                            :disabled="$field['disabled'] ?? false"
                                            :id="$field['id'] ?? null"
                                            :class="$field['class'] ?? null"/>
                                @break

                                @case('select_multiple')
                                <x-dropdown-multiple :name="$field['name']" :options="$field['options']"
                                                     :label="$field['label']"
                                                     :placeholder="$field['placeholder'] ?? null"
                                                     :required="$field['required'] ?? false"
                                                     :value="old($field['name'], $field['value'] ?? ($model->{$field['name']} ?? ''))"
                                                     :class="$field['class'] ?? null"/>
                                @break

                                @case('datepicker')
                                <x-datepicker :label="$field['label']" :name="$field['name']"
                                              :placeholder="$field['placeholder'] ?? ''"
                                              :required="$field['required'] ?? false"
                                              :value="old($field['name'], $field['value'] ?? ($model->{$field['name']} ?? ''))"
                                              :helpText="$field['help_text'] ?? ''"
                                              :class="$field['class'] ?? ''"/>
                                @break

                                @case('radio_group')
                                <x-radio-group :name="$field['name']" :options="$field['options']"
                                               :label="$field['label']"
                                               :inline="$field['inline'] ?? true"
                                               :required="$field['required'] ?? false"
                                               :id="$field['id'] ?? ''"
                                               :value="old($field['name'], $field['value'] ?? ($model->{$field['name']} ?? ''))"
                                               :helpText="$field['help_text'] ?? ''"
                                               :class="$field['class'] ?? null"/>
                                @break

                                @case('text')
                                @case('password')
                                @case('email')
                                @default
                                <x-text-field :label="$field['label']" :name="$field['name']" :type="$field['type']"
                                              :placeholder="$field['placeholder'] ?? null"
                                              :required="$field['required'] ?? false"
                                              :readOnly="$field['readonly'] ?? false"
                                              :disabled="$field['disabled'] ?? false"
                                              :value="old($field['name'], $field['value'] ?? ($model->{$field['name']} ?? ''))"
                                              :helpText="$field['help_text'] ?? ''"
                                              :class="$field['class'] ?? ''"/>
                            @endswitch
                        @endforeach

                        {{ $slot ?? '' }}
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-12">
                                <button type="submit"
                                        class="btn btn-primary">{{ $mode == 'update' ? __('ttdt.update') : __('ttdt.create') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Form-->
        </div>
    </form>
</div>

