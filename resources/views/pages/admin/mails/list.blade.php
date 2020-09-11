@extends('layouts.app')

@section('title', $title)

@section('content-header')
    <x-list-content-head :title="$title" :createButtonLabel="__('ttdt.create')" :createRoute="$routePrefix.'.create'" />
@endsection

@section('content')
    <x-list-table :id="$routePrefix" colClass=""></x-list-table>
@endsection

@section('script')
    <script>
        $(function() {
            let columns = [
                {
                    field: 'action',
                    width: 70,
                    title: '@lang('ttdt.list.action_heading')',
                    sortable: false,
                    textAlign: 'center',
                    template: function (row, index, datatable) {
                        let editLabel = '@lang('ttdt.list.button_tooltip_edit')';
                        let deleteLabel = '@lang('ttdt.list.button_tooltip_delete')';
                        let route = "{{ route("$routePrefix.edit", '@@@') }}";
                        route = route.replace('@@@', row.id);
                        return `<a href="${route}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="${editLabel}">
                                <i class="la la-edit fa-2x"></i>
                            </a>`;
                    }
                },
                {
                    field: 'id',
                    title: '#',
                    width: 40,
                    type: 'number',
                    selector: false,
                    textAlign: 'center',
                    sortable: true
                },
                {
                    field: 'key',
                    title: '@lang('Key')',
                    width: 150,
                },
                {
                    field: 'header',
                    title: '@lang('ttdt.list.header')',
                    width: 200,
                },
                {
                    field: 'bofy',
                    title: '@lang('ttdt.list.body')',
                    width: 400,
                },
            ];

            let ajaxUrl = "{{ route("$routePrefix.datatable") }}";
            let datatable = initKTDatatable('.datatable', ajaxUrl, columns, '#generalSearch');


        })
    </script>
@endsection
