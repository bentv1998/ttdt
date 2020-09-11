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
        'label' => __('Key'),
        'name' => 'key',
    ],
    [
        'type' => 'text',
        'label' => __('ttdt.list.header'),
        'name' => 'header',
        'required' => true,
    ],
    [
        'type' => 'textarea',
        'label' => __('ttdt.list.body'),
        'name' => 'body',
        'id' => 'body',
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
                     :fields="$fields" :model="$model"/>
@endSection

@section('script')
    <script data-require="marked@*" data-semver="0.3.1"
            src="http://cdnjs.cloudflare.com/ajax/libs/marked/0.3.1/marked.js"></script>
    <script src="https://cdn.rawgit.com/toopay/bootstrap-markdown/master/js/bootstrap-markdown.js
"></script>
    <script src="https://rawgit.com/lodev09/jquery-filedrop/master/jquery.filedrop.js
"></script>
    <script src="https://rawgit.com/jeresig/jquery.hotkeys/master/jquery.hotkeys.js"></script>
    <script>
        $(`#body`).markdown({
            autofocus: false,
            height: 270,
            iconlibrary: 'fa',
            onShow: function (e) {
                e.change(e);
            },
        })

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
            minuteStep: 1,
            showSeconds: false,
            showMeridian: false,
            snapToStep: true
        });
    </script>
@endSection
@push('css')
    <link data-require="bootstrap-css@3.1.1" data-semver="3.1.1" rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
    <link data-require="fontawesome@4.1.0" data-semver="4.1.0" rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.rawgit.com/toopay/bootstrap-markdown/master/css/bootstrap-markdown.min.css" />
    <style>
        #body {
            padding: 25px!important;
        }
    </style>
@endpush
