<?php
$mode = $mode ?? '';
$model = $model ?? null;
$storeRoute = "$routePrefix.store";
$updateRoute = "$routePrefix.update";
$breadcrumb = [
    [
        'route' => "categories.index",
        'label' => __('ttdt.list.label')
    ],
    [
        'route' => '',
        'label' => $mode === 'update' ? __('ttdt.update') : __('ttdt.create'),
        'isLast' => true
    ]
];

$fields = [
    [
        'type' => 'text',
        'label' => __('ttdt.list.category'),
        'name' => 'category',
        'value' => $category->name,
        'disabled' => true,
    ],
    [
        'type' => 'text',
        'label' => __('ttdt.list.name'),
        'name' => 'name',
        'required' => true,
    ],
    [
        'type' => 'number',
        'label' => __('ttdt.list.sku'),
        'name' => 'sku',
        'required' => true,
    ],
    [
        'type' => 'number',
        'label' => __('ttdt.list.price'),
        'name' => 'price',
        'required' => true,
    ],
    [
        'type' => 'number',
        'label' => __('ttdt.list.discount'),
        'name' => 'discount',
        'value' => $model->discount ?? 0,
    ],
    [
        'type' => 'hidden',
        'label' => __('ttdt.list.img'),
        'name' => 'img',
        'id' => 'img',
    ],
    [
        'type' => 'textarea',
        'label' => __('ttdt.list.description'),
        'name' => 'description',
    ],
];

?>
@extends('layouts.app')

@section('title', $title)

@section('content-header')
    <x-content-head :title="$title" :breadcrumb="$breadcrumb"/>
@endsection

@section('content')
    <x-standard-form :title="$title" :mode="$mode" :storeRoute="$storeRoute" :updateRoute="$updateRoute" :mode="$mode"
                     :fields="$fields" :model="$model" >
        <input type="hidden" name="category_id" value="{{ $category->id }}">
        <div class="row">
            <div class="col-lg-2 col-form-label">
                @lang('ttdt.list.image')
            </div>
            <div class="col-lg-6">
                <div id="avatar">
                    <i class="fas fa-edit"
                       title="@lang('ttdt.choose') @lang('ttdt.list.image')"
                       onclick="document.getElementById('choose-file').click();"
                    ></i>
                    <input type="file" name="file" class="d-none" id="choose-file" value="{{ old('file') ?? '' }}">
                    <img id="show-img" width="200" src="{{ $model->user->image ?? '' }}"/>
                </div>
            </div>
        </div>
    </x-standard-form>
@endSection

@section('script')
    <script>
        $("#kt_page_sticky_card").validate({
            rules: {
                name: {
                    required: true,
                },
                sku: {
                    required: true,
                    number: true,
                    min: 0
                },
                price: {
                    required: true,
                    number: true,
                    min: 0
                },
                discount: {
                    number: true,
                    min: 0
                },
            },
            messages:{
                name: {
                    required: "@lang('validation.required', ['attribute' => __('ttdt.list.name')])",
                },
                sku: {
                    required: "@lang('validation.required', ['attribute' => __('ttdt.list.sku')])",
                    number: "@lang('validation.numeric', ['attribute' => __('ttdt.list.sku')])",
                    min: "@lang('validation.min.numeric', ['attribute' => __('ttdt.list.sku'), 'min' => 0])",
                },
                price: {
                    required: "@lang('validation.required', ['attribute' => __('ttdt.list.price')])",
                    number: "@lang('validation.numeric', ['attribute' => __('ttdt.list.price')])",
                    min: "@lang('validation.min.numeric', ['attribute' => __('ttdt.list.price'), 'min' => 0])",
                },
                discount: {
                    number: "@lang('validation.numeric', ['attribute' => __('ttdt.list.discount')])",
                    min: "@lang('validation.min.numeric', ['attribute' => __('ttdt.list.discount'), 'min' => 0])",
                },
            },
            invalidHandler: function (event, validator) {
                toastr.error('@lang('ttdt.message.error.form_validation')');
            },

            submitHandler: function (form) {
                form.submit(); // submit the form
            }
        });

        $(document).ready(function () {
            $('#img').parents('.form-group').hide();

            let file = $('#choose-file');

            file.change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#show-img')
                            .attr('src', e.target.result)
                            .width(200);
                        $('#img').val(e.target.result);
                    };

                    reader.readAsDataURL(this.files[0]);
                }
            })
        });


    </script>
@endSection

@push('css')
    <style>
        #avatar {
            height: 200px;
            width: 200px;
            background: none;
            border: 1px solid #e5eaee;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: .42rem;
        }

        #avatar .fa-edit {
            position: absolute;
            top: 10px;
            right: 10px;
            opacity: 0;
            transition-duration: 1s;
            cursor: pointer;
        }

        #choose-file {
            vertical-align: middle
        }

        #avatar:hover .fa-edit {
            opacity: 1;
            transition-duration: 1s
        }
    </style>
@endpush
