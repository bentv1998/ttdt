<div class="row" id="{{ $id ?? '' }}">
    @foreach($groupElement as $element)
        <div class="col-lg-6">
            @if($showBeneficiary)
            <x-user-dropdown :name="$element['beneficiary_id']"
                             :options="$beneficiaries"
                             :class="'select_beneficiaries'"
                             :value="$model->{$element['beneficiary_id']}->beneficiary_id ?? ''"
                             :label="__('preta.living_will.label_choose_beneficiary')"
                             :placeholder="__('preta.living_will.choose_beneficiary')"
                             :value="old($element['beneficiary_id'], $model->{$element['personOfDecision']}->beneficiary_id ?? '')"
                             :helpText="''"/>
            @endif

            <label>@lang($label)</label>

            <x-user-text-field :label="__('preta.living_will.form.label.name')"
                               :name="$element['name']" :type="'text'"
                               :placeholder="__('preta.living_will.form.placeholder.name')"
                               :value="old($element['name'], $model->{$element['personOfDecision']}->name ?? '')"/>

            @if(isset($element['relation']))
            <x-user-text-field :label="__('preta.living_will.form.label.relation')"
                               :name="$element['relation']" :type="'text'"
                               :placeholder="__('preta.living_will.form.placeholder.relation')"
                               :value="old($element['relation'], $model->{$element['personOfDecision']}->relation ?? '')"/>
            @endif

            <x-user-text-field :label="__('preta.living_will.form.label.phone')"
                               :name="$element['phone']"
                               :type="'tel'"
                               :placeholder="__('preta.living_will.form.placeholder.phone')"
                               :value="old($element['phone'], $model->{$element['personOfDecision']}->phone ?? '')"/>

            <x-user-text-field :label="__('preta.living_will.form.label.email')"
                               :name="$element['email']"
                               :type="'text'"
                               :placeholder="__('preta.living_will.form.placeholder.email')"
                               :value="old($element['email'], $model->{$element['personOfDecision']}->email ?? '')"/>
        </div>
    @endforeach
    <div class="col-lg-6">

    </div>
</div>
