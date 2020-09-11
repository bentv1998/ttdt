<?php
$mode = $mode ?? '';
$model = $model ?? null;
$storeRoute = "$routePrefix.store";
$updateRoute = "$routePrefix.update";

if ($model) {
    $model->day = json_decode($model->day);
}

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
        'required' => true,
    ],
    [
        'type' => 'text',
        'label' => __('ttdt.list.time')." (24h)",
        'name' => 'time',
        'id' => 'time',
        'required' => true,
    ],
    [
        'type' => 'select_multiple',
        'label' => __('ttdt.list.day'),
        'options' => $dates ?? [],
        'name' => 'day',
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $("#kt_page_sticky_card").validate({
            rules: {
                name: {
                    required: true,
                },
                time: {
                    required: true,
                },
                day: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "@lang('validation.required', ['attribute' => __('ttdt.list.name')])",
                },
                time: {
                    required: "@lang('validation.required', ['attribute' => __('ttdt.list.time')])",
                },
                day: {
                    required: "@lang('validation.required', ['attribute' => __('ttdt.list.day')])",
                },
            },
            invalidHandler: function (event, validator) {
                toastr.error('@lang('ttdt.message.error.form_validation')');
            },

            submitHandler: function (form) {
                form.submit(); // submit the form
            }
        });

        $('#time').timepicker({
            timeFormat: 'H:mm',
            minuteStep: 1,
            showSeconds: false,
            showMeridian: false,
            snapToStep: true
        });
    </script>
@endSection
