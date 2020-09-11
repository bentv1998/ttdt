<div class="container-fluid">
    <div class="row">
        <div class="col-12 {{ $colClass ?? '' }}">
            <div class="portlet portlet-mobile ">
                <div class="card card-custom">
                    <div class="card-body">
                        @if(!empty($filters))
                            <x-list-sub-head :filters="$filters"></x-list-sub-head> @endif
                        <div class="portlet-body portlet-body-fit">
                            <div id="datatable-{{ $id }}"
                                 class="table table-striped datatable dataTables_scrollBody {{ $class ?? '' }}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('css')
    <style>
        .datatable-table {
            overflow-x: auto!important;
        }
    </style>
@endpush
