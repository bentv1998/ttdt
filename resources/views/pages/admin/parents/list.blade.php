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
                    field: 'image',
                    title: '@lang('ttdt.list.image')',
                    width: 150,
                    template: function (row) {
                        return row.user ? `<img width="100" src="${row.user.image}">` : '';
                    }
                },
                {
                    field: 'code',
                    title: '@lang('ttdt.list.code')',
                    width: 150,
                },
                {
                    field: 'name',
                    title: '@lang('ttdt.list.name')',
                    width: 200,
                    template: function (row) {
                        return row.user ? row.user.name : '';
                    }
                },
                {
                    field: 'email',
                    title: '@lang('ttdt.list.email')',
                    width: 150,
                },
                {
                    field: 'phone',
                    title: '@lang('ttdt.list.phone')',
                    width: 100,
                },
            ];

            let ajaxUrl = "{{ route("$routePrefix.datatable") }}";
            let datatable = initKTDatatable('.datatable', ajaxUrl, columns, '#generalSearch');

            let deleteUrl = "{{ route("$routePrefix.destroy", '@@@') }}";
            bindDeleteButton(datatable, deleteUrl, '{{ $title }}');

        })
    </script>
@endsection
