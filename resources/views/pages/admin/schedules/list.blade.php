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
        let listDate = @json($dates);
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
                            </a>
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md row-delete" data-id="${row.id}" title="${deleteLabel}">
                                <i class="la la-trash fa-2x"></i>
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
                    field: 'name',
                    title: '@lang('ttdt.list.name')',
                    width: 150,
                },
                {
                    field: 'day',
                    title: '@lang('ttdt.list.day')',
                    width: 200,
                    template: function (row) {
                        let str = '';
                        JSON.parse(row.day).map(function (item) {
                            str += `<span class="mx-2 text-dark-75">${listDate[item]}</spam>`;
                        })
                        return str;
                    }
                },
                {
                    field: 'time',
                    title: '@lang('ttdt.list.time')',
                    width: 80,
                },
            ];

            let ajaxUrl = "{{ route("$routePrefix.datatable") }}";
            let datatable = initKTDatatable('.datatable', ajaxUrl, columns, '#generalSearch');

            let deleteUrl = "{{ route("$routePrefix.destroy", '@@@') }}";
            bindDeleteButton(datatable, deleteUrl, '@lang('ttdt.menu.classes')');

        })
    </script>
@endsection
