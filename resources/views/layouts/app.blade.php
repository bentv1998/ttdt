<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!-- Styles -->
    <link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @toastr_css
    @yield('style')
    @stack('css')
</head>
<body
    class="quick-panel--right demo-panel--right offcanvas-panel--right header--fixed header-mobile--fixed subheader--enabled subheader--fixed subheader--solid aside--enabled aside--fixed page--loading">

<!-- begin:: Page -->

@includeWhen(Auth::check(), 'layouts.partials.header-mobile')

<div class="d-flex flex-column flex-root">
    @if(Auth::check())
        <div class="d-flex flex-row flex-column-fluid page">
            @include('layouts.partials.aside')
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                @include('layouts.partials.header')
                <div class="content d-flex flex-column flex-column-fluid py-0" id="kt_content">
                    @yield('content-header')
                    <div class="d-flex flex-column-fluid py-10">
                        @yield('content')
                    </div>
                </div>
                @include('layouts.partials.footer')
            </div>
        </div>
    @else
        @yield('content')
    @endif
</div>
<!-- end:: Page -->

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="scrolltop">
    <i class="la la-arrow-up"></i>
</div>
<!-- end::Scrolltop -->

@stack('modals')
<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#233256",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": [
                    "#c5cbe3",
                    "#a1a8c3",
                    "#3d4465",
                    "#3e4466"
                ],
                "shape": [
                    "#f0f3ff",
                    "#d9dffa",
                    "#afb4d4",
                    "#646c9a"
                ]
            }
        }
    };
</script>

@include('layouts.partials.config')
<!-- end::Global Config -->
<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('js/scripts.bundle.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ asset('/plugins/custom/inputmask.min.js') }}"></script>
{{--<script src="{{ asset('/plugins/custom/html2pdf.min.js') }}"></script>--}}

@toastr_render
@include('layouts.partials.common-js')
@yield('script')
@stack('scripts')

</body>
</html>
