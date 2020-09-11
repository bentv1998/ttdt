<div class="portlet-body portlet-body-fit">
    <div class="form form-label-right margin-t-20 margin-b-10">
        <div class="row align-items-center">
            <div class="col-xl-12 order-2 order-xl-1">
                <div class="row align-items-center">
                    @foreach ($filters as $filter)
                        <x-list-filter :id="$filter['id']" :name="$filter['name']" :class="$filter['class'] ?? null"
                                  :colClass="$filter['colClass'] ?? null" :label="$filter['label'] ?? null"
                                  :placeholder="$filter['placeholder'] ?? null" :options="$filter['options']">
                        </x-list-filter>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
