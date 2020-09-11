<?php
$mode = $mode ?? '';
$model = $model ?? null;
$storeRoute = "$routePrefix.store";
$updateRoute = "$routePrefix.update";
$breadcrumb = [
    [
        'route' => "$routePrefix.index",
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
        'label' => __('ttdt.list.name'),
        'name' => 'name',
        'value' => $model->user->name ?? '',
        'required' => true,
    ],
    [
        'type' => 'tel',
        'label' => __('ttdt.list.phone'),
        'name' => 'phone',
        'required' => true,
    ],
    [
        'type' => 'datepicker',
        'label' => __('ttdt.list.birth'),
        'name' => 'birth',
    ],
    [
        'type' => 'email',
        'label' => __('ttdt.list.email'),
        'value' => $model->user->email ?? '',
        'name' => 'email',
        'required' => true,
    ],
    [
        'type' => 'select',
        'label' => __('ttdt.list.gender'),
        'name' => 'gender',
        'options' => $genders ?? [],
        'required' => true,
    ],
    [
        'type' => 'password',
        'label' => __('ttdt.list.password'),
        'name' => 'password',
        'required' => $mode === 'update' ? false : true,
    ],
    [
        'type' => 'password',
        'label' => __('ttdt.list.password_confirm'),
        'name' => 'password_confirmation',
        'required' => $mode === 'update' ? false : true,
    ],
    [
        'type' => 'hidden',
        'label' => __('ttdt.list.image'),
        'name' => 'image',
        'id' => 'image',
        'value' => $model->user->image ?? '',
        'required' => true,
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
                phone: {
                    required: true,
                    number: true
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: "{{ $mode != 'update' ? 'true' : 'false' }}",
                    minlength: 6
                },
                password_confirmation: {
                    equalTo: "#password"
                }
            },
            invalidHandler: function (event, validator) {
                toastr.error('@lang('ttdt.message.error.form_validation')');
            },

            submitHandler: function (form) {
                form.submit(); // submit the form
            }
        });

        $(document).ready(function () {
            $('#image').parents('.form-group').hide();

            let file = $('#choose-file');

            file.change(function () {
                if (this.files && this.files[0]) {
                    console.log(this.files[0])
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#show-img')
                            .attr('src', e.target.result)
                            .width(200);
                        $('#image').val(e.target.result);
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
