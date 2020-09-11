<?php
$mode = $mode ?? 'create';
$model = $model ?? null;
$storeRoute = "$routePrefix.store";
$updateRoute = "$routePrefix.update";
$classIds = $model->classes->pluck('id')->toArray() ?? [];
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
        'type' => 'select',
        'label' => __('ttdt.list.parent'),
        'name' => 'parent_id',
        'options' => $model->parent->pluck('email', 'id') ?? [],
        'value' => $model->parent_id ?? '',
        'id' => 'kt_select2_6',
        'required' => true,
        'disabled' => $mode === 'update'
    ],
    [
        'type' => 'text',
        'label' => __('ttdt.list.name'),
        'name' => 'name',
        'required' => true,
    ],
    [
        'type' => 'datepicker',
        'label' => __('ttdt.list.birth'),
        'name' => 'birth',
    ],
    [
        'type' => 'select',
        'label' => __('ttdt.list.gender'),
        'name' => 'gender',
        'options' => $genders ?? [],
        'required' => true,
    ],
    [
        'type' => 'select_multiple',
        'label' => __('ttdt.all') . ' ' . __('ttdt.menu.classes'),
        'name' => 'classIds',
        'options' => $classes ?? [],
        'value' => $classIds,
        'required' => true,
    ],
    [
        'type' => 'hidden',
        'label' => '',
        'name' => 'img',
        'class' => 'd-none',
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
                     :fields="$fields" :model="$model">
    </x-standard-form>
@endSection

@section('script')
    <script>
        $("#kt_page_sticky_card").validate({
            rules: {
                name: {
                    required: true,
                },
                gender: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "@lang('validation.required', ['attribute' => __('ttdt.list.name')])",
                },
                gender: {
                    required: "@lang('validation.required', ['attribute' => __('ttdt.list.gender')])",
                }
            },
            invalidHandler: function (event, validator) {
                toastr.error('@lang('ttdt.message.error.form_validation')');
            },

            submitHandler: function (form) {
                form.submit(); // submit the form
            }
        });

        initSelect2("{{ route('students.search.parent') }}", 'kt_select2_6')
    </script>
@endSection
