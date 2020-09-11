<div class="container">
    <div class="card card-custom">
        <div class="card-body p-0">
            <div class="wizard wizard-3" id="kt_wizard_v3" data-wizard-state="first" data-wizard-clickable="true">
                <!--begin: Wizard Nav-->
                <div class="wizard-nav">
                    <div class="wizard-steps px-8 py-8 px-lg-15 py-lg-3">
                        @foreach($wizards as $key => $value)
                            <div class="wizard-step" data-wizard-type="step"  @if($key === 0) data-wizard-state="current" @else data-wizard-state="pending" @endif >
                                <div class="wizard-label">
                                    <h3 class="wizard-title">
                                        <span>{{ ++$key }}.</span> {{ $value['title'] }}
                                    </h3>
                                    <div class="wizard-bar"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row justify-content-center py-10 px-8 py-lg-12 px-lg-10">
                    <div class="col-xl-12 col-xxl-7">
                        <form class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_form">
                            <!--begin: Wizard Step 1-->
                            @foreach($wizards as $key => $value)
                                <?php
                                $fields = $value['fields'];
                                $model = $value['model'];
                                ?>
                                <div class="pb-5" data-wizard-type="step-content" @if($key === 0) data-wizard-state="current" @endif>
                                    <h4 class="mb-10 font-weight-bold text-dark">{{ $value['title'] }}</h4>
                                    <!--begin::Input-->
                                    @foreach($fields as $field)
                                        @switch($fieeld['type'])
                                            @case('select')
                                            <x-dropdown :name="$field['name']" :options="$field['options']"
                                                        :label="$field['label']"
                                                        :placeholder="$field['placeholder']"
                                                        :required="$field['required'] ?? false"
                                                        :value="old($field['name'], $field['value'] ?? ($model->{$field['name']} ?? ''))"
                                                        :helpText="$field['help_text'] ?? ''"
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
                                            <x-datepicker :label="$field['label']" :name="$field['name']"
                                                          :placeholder="$field['placeholder']"
                                                          :required="$field['required'] ?? false"
                                                          :value="old($field['name'], $field['value'] ?? ($model->{$field['name']} ?? ''))"
                                                          :helpText="$field['help_text'] ?? ''"
                                                          :class="$field['class'] ?? ''"/>
                                            @break

                                            @case('radio_group')
                                            <x-radio-group :name="$field['name']" :options="$field['options']"
                                                           :label="$field['label']"
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
                                            <x-text-field :label="$field['label']" :name="$field['name']"
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
                            @endforeach

                            <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                <div class="mr-2">
                                    <button class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-prev">
                                        Previous
                                    </button>
                                </div>
                                <div>
                                    <button class="btn btn-success font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-submit">
                                        Submit
                                    </button>
                                    <button class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-next">
                                        Next Step
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
