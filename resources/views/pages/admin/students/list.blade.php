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
                    field: 'name',
                    title: '@lang('ttdt.list.name')',
                    width: 150,
                },
                {
                    field: 'birth',
                    title: '@lang('ttdt.list.birth')',
                    width: 100,
                },
                {
                    field: 'parent_id',
                    title: '@lang('ttdt.list.parent')',
                    width: 150,
                    template: function (row) {
                        return row.parent ? row.parent.email : ''
                    }
                },
                {
                    field: 'gender',
                    title: '@lang('ttdt.list.gender')',
                    width: 100,
                    template: function (row) {
                        return row.gender ? '@lang($genders[1])' : '@lang($genders[0])'
                    }
                },
            ];

            let ajaxUrl = "{{ route("$routePrefix.datatable") }}";
            let datatable = initKTDatatable('.datatable', ajaxUrl, columns, '#generalSearch');

            let deleteUrl = "{{ route("$routePrefix.destroy", '@@@') }}";
            bindDeleteButton(datatable, deleteUrl, '@lang('preta.menu.classes')');

        })
    </script>
@endsection
