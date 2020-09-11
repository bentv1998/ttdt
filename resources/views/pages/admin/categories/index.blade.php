<?php
$mode = $mode ?? 'list';
?>
@extends('layouts.app')

@section('title', $title)

@section('content-header')
    <x-list-content-head :title="$title" :createButtonLabel="__('ttdt.create')" :createRoute="null"/>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet portlet-mobile ">
                    @if($models ?? false)
                        @foreach($models as $model)
                            <div class="card mb-5 category">
                                <div class="card-header d-flex justify-content-between ">
                                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ $model->name ?? '' }}</h5>
                                    <div class="subheader__toolbar">
                                        @if($mode === 'list' && count($model->products) > 3)
                                            <a href="{{ route('categories.show', $model) }}"
                                               class="btn btn-light-primary">
                                                <i class="fas fa-list-ul"></i> @lang('ttdt.see') @lang('ttdt.all')
                                            </a>
                                        @endif
                                        <a class="btn btn-light-success btn-edit" href="#"
                                           data-edit="{{ route("$routePrefix.edit", $model) }}"
                                           data-update="{{ route("$routePrefix.update", $model) }}"
                                        >
                                            <i class="far fa-edit"></i> @lang('ttdt.edit') @lang('ttdt.list.category')
                                        </a>
                                        <a class="btn btn-light-danger row-delete category-delete" href="#"
                                           data-id="{{ $model->id }}"
                                        > <i
                                                class="far fa-trash-alt"></i> @lang('ttdt.delete') @lang('ttdt.list.category')
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body row">
                                    @if($model->products ?? false)
                                        @foreach($model->products as $item)
                                            <?php
                                            $img = $item->img ? $item->img : 'assets/images/ttdt.png';
                                            $listInfo = [
                                                'code' => 0,
                                                'price' => 1,
                                                'sku' => 0,
                                                'discount' => 1
                                            ]
                                            ?>
                                            <div class="col-md-3">
                                                <div
                                                    class="card card-custom gutter-b card-stretch border border-1 product">
                                                    <div
                                                        class="card-body pt-4 d-flex flex-column justify-content-between">
                                                        <div class="d-flex align-items-center mb-7">
                                                            <img width="100" src="{{ asset($img) }}"
                                                                 alt="{{ $item->code }}">
                                                            <h5>{{ $item->name }}</h5>
                                                        </div>
                                                        <div class="mb-7">
                                                            @foreach($listInfo as $option => $isMoney)
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <span class="text-dark-75 font-weight-bolder mr-2">@lang("ttdt.list.$option"):</span>
                                                                    <span
                                                                        class="text-muted text-hover-primary">{{ $isMoney ? number_format($item->{$option}, 0).' (VNĐ)' : $item->{$option} }}</span>
                                                                </div>
                                                            @endforeach

                                                            <div
                                                                class="d-flex justify-content-between align-items-center">
                                                                <div
                                                                    class="text-dark-75 font-weight-bolder mr-2">@lang('ttdt.list.description')
                                                                    :
                                                                </div>
                                                                <div
                                                                    class="text-muted text-hover-primary">{{ $item->description }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <a class="btn btn-light-success"
                                                           href="{{ route('products.edit', $item) }}">
                                                            <i class="far fa-edit"></i> @lang('ttdt.edit') @lang('ttdt.list.product')
                                                        </a>
                                                        <a class="btn btn-light-danger product-delete row-delete"
                                                           href="#" data-id="{{ $item->id }}">
                                                            <i class="far fa-trash-alt"></i> @lang('ttdt.delete') @lang('ttdt.list.product')
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="card-footer text-center">
                                    <a class="btn w-50 btn-light-linkedin"
                                       href="{{ route('products.create') . "?category_id=$model->id" }}"> <i
                                            class="flaticon2-add-1"></i> @lang('ttdt.add') @lang('ttdt.list.product')
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        @if($mode === 'list')
            {!!  $models->links() !!}
        @endif

        <div class="modal fade" id="categoryModal" data-backdrop="static" tabindex="-1" role="dialog"
             aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal Title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <form id="categoryForm" method="POST">
                        @csrf
                        <input type="hidden" class="method" name="_method" value="PUT">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>@lang('ttdt.list.name')</label>
                                <input type="text" class="form-control name" name="name"
                                       placeholder="@lang('ttdt.enter') @lang('ttdt.list.name')"/>
                            </div>

                            <div class="form-group">
                                <label>@lang('ttdt.list.description')</label>
                                <textarea class="form-control description" name="description"
                                          placeholder="@lang('ttdt.enter') @lang('ttdt.list.description')"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                    data-dismiss="modal">@lang('ttdt.close')
                            </button>
                            <button type="submit" class="btn btn-primary font-weight-bold">@lang('ttdt.save')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endSection

@section('script')
    <script>
        $(document).ready(function () {
            let modal = $('#categoryModal'),
                modalHeader = $('#categoryModal .modal-title'),
                form = $('#categoryForm'),
                formMethod = $('#categoryForm .method'),
                modalName = $('#categoryForm .name'),
                modalDescription = $('#categoryForm .description');

            categoryValidate();

            $('.btn-light-facebook').click(function () {
                modalHeader.text(`{{ $title }} @lang('ttdt.create')`)
                modal.modal('show');
                formMethod.val('POST');
                form.attr('action', '{{ route("$routePrefix.store") }}');
            })

            $('.btn-edit').on('click', function () {
                let urlEdit = $(this).data('edit');
                let urlUpdate = $(this).data('update');
                modalHeader.text(`{{ $title }} @lang('ttdt.edit')`)
                modal.modal('show');
                formMethod.val('PUT');
                form.attr('action', urlUpdate);
                $.ajax({
                    url: urlEdit,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                    },
                    success: function (result) {
                        modalName.val(result.model.name)
                        modalDescription.val(result.model.description)
                    }
                })
            })

            let deleteProductUrl = "{{ route("products.destroy", '@@@') }}";
            let deleteCategoryUrl = "{{ route("$routePrefix.destroy", '@@@') }}";

            handleDeleteButton($('.product-delete'), deleteProductUrl, '@lang('ttdt.menu.products')', true, '.product');
            handleDeleteButton($('.category-delete'), deleteCategoryUrl, '@lang('ttdt.menu.categories')', true, '.category');
        })

        function categoryValidate() {
            $('#categoryForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "@lang('validation.required', ['attribute' => __('ttdt.list.name')])",
                    },
                },
                invalidHandler: function (event, validator) {
                    toastr.error('@lang('ttdt.message.error.form_validation')');
                },

                submitHandler: function (form) {
                    form.submit(); // submit the form
                }
            });
        }
    </script>
@endSection

@push('css')
    <style>
        #kt_subheader_search {
            display: none !important;
        }
    </style>
@endpush
