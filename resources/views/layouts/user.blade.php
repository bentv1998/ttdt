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
    <style>
        ::-webkit-scrollbar {
            width: 2px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        body {
            background-image: url(/media/bg/bg-10.jpg);
            background-repeat: no-repeat;
            background-position: center top;
            background-size: 100% 350px;
            overflow-y: hidden;
        }

        #kt_header {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            height: 80px;
            -webkit-box-shadow: none;
            box-shadow: none;
            position: relative;
            z-index: 2;
            border-bottom: 1px solid rgba(255,255,255,.1);
            background: none;
        }

        #kt_header, #kt_header .btn-icon:not(:hover) i {
            color: white;
        }

        #kt_header .navi {
            color: #000000;
        }

        #kt_content {
            height: 1000px;
            overflow-y: auto;
        }
    </style>
    @toastr_css
    @yield('style')
    @stack('css')
</head>
<body
    class="quick-panel--right demo-panel--right offcanvas-panel--right header--fixed header-mobile--fixed subheader--enabled subheader--fixed subheader--solid aside--enabled aside--fixed page--loading">

<!-- begin:: Page -->

<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid page">
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            @include('layouts.user-partials.header')
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <div class="subheader py-2 py-lg-12 subheader-transparent">
                    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                        @yield('content-header')
                    </div>
                </div>
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        @yield('content')
                        @for($i = 0; $i< 1000; $i++)
                            <h3>{{ $i }}</h3>
                        @endfor
                    </div>
                </div>
            </div>
            @include('layouts.partials.footer')
        </div>
    </div>
</div>
<!-- end:: Page -->

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<!--begin::Svg Icon | path:../../../../../metronic/themes/metronic/theme/html/demo2/dist/assets/media/svg/icons/Navigation/Up-2.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24"></polygon>
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"></rect>
						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero"></path>
					</g>
				</svg>
                <!--end::Svg Icon-->
			</span>
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

@toastr_render
@include('layouts.partials.common-js')
@yield('script')
@stack('scripts')

</body>
</html>
