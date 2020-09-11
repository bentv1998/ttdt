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
        'type' => 'select',
        'label' => __('ttdt.list.teacher'),
        'name' => 'teacher_id',
        'options' => $users ?? [],
        'value' => $model->teacher_id ?? '',
        'id' => 'teacher_id',
        'required' => true,
    ],
    [
        'type' => 'select',
        'label' => __('ttdt.list.schedule'),
        'name' => 'schedule_id',
        'options' => $users ?? [],
        'value' => $model->schedule_id ?? '',
        'id' => 'schedule_id',
        'required' => true,
    ],
    [
        'type' => 'text',
        'label' => __('ttdt.list.name'),
        'name' => 'name',
        'required' => true,
    ],
    [
        'type' => 'text',
        'label' => __('ttdt.list.tuition'),
        'name' => 'tuition',
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
                     :fields="$fields" :model="$model" />
@endSection

@section('script')
    <script>
        $("#kt_page_sticky_card").validate({
            rules: {
                name: {
                    required: true,
                },
                tuition: {
                    required: true,
                    number: true
                },
                teacher_id: {
                    required: true,
                },
                schedule_id: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "@lang('validation.required', ['attribute' => __('ttdt.list.teacher')])",
                },
                tuition: {
                    required: "@lang('validation.required', ['attribute' => __('ttdt.list.schedule')])",
                    number: "@lang('validation.numeric', ['attribute' => __('ttdt.list.schedule')])",
                },
                teacher_id: {
                    required: "@lang('validation.required', ['attribute' => __('ttdt.list.name')])",
                },
                schedule_id: {
                    required: "@lang('validation.required', ['attribute' => __('ttdt.list.tuition')])",
                },
            },
            invalidHandler: function (event, validator) {
                toastr.error('@lang('ttdt.message.error.form_validation')');
            },

            submitHandler: function (form) {
                form.submit(); // submit the form
            }
        });

        initSelect2("{{ route('classes.search.teacher') }}", 'teacher_id')
        initSelect2("{{ route('classes.search.schedule') }}", 'schedule_id')
    </script>
@endSection
