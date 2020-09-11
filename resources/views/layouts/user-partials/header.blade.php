<?php
use App\Models\Category;use Illuminate\Support\Str;$items = [
    [
        'type' => 'icon',
        'icon' => 'flaticon2-settings',
        'route' => '',
    ],
];

$languages = [
    'vi' => [
        'img' => '220-vietnam.svg',
        'title' => 'VietNam'
    ],
    'en' => [
        'img' => '226-united-states.svg',
        'title' => 'English'
    ]
];

$menuCategories = [];
$categories = Category::all();
foreach ($categories as $category) {
    array_push($menuCategories,[
        'title' => $category->name,
        'href' => Str::slug($category->name)
    ]);
}

$menus = [
    [
        'title' => 'ttdt.menu.home',
        'href' => route('home.user')
    ],
    [
        'title' => 'ttdt.menu.categories',
        'children' => $menuCategories
    ],
    [
        'title' => 'ttdt.menu.teachers',
        'href' => '#'
    ],

];

$langNow = $languages[config('app.locale')];
?>
<!-- begin:: Header -->
<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container d-flex align-items-stretch justify-content-between">
        <!--begin::Left-->
        <div class="d-flex align-items-stretch mr-3">
            <!--begin::Header Logo-->
            <div class="header-logo flex-column-auto d-flex">
                <a href="/" class=" d-flex">
                    <img alt="Logo" src="{{ asset("assets/images/ttdt-white.png") }}" class="logo-default max-h-40px my-auto">
                </a>
            </div>
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default ml-5">
                <!--begin::Header Nav-->
                <ul class="menu-nav">
                    @foreach($menus as $menu)
                    <li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-active" data-menu-toggle="click" aria-haspopup="true">
                        <a href="{{ $menu['href'] ?? 'javascript:;' }}" class="menu-link @if(!isset($menu['href'])) menu-toggle @endif bg-hover-white-o-1">
                            <span class="menu-text text-white">@lang($menu['title'])</span>
                            <i class="menu-arrow"></i>
                        </a>
                        @if($menu['children'] ?? false)
                        <div class="menu-submenu menu-submenu-classic menu-submenu-left" data-hor-direction="menu-submenu-left">
                            <ul class="menu-subnav">
                                @foreach($menu['children'] as $item)
                                <li class="menu-item menu-item-active" aria-haspopup="true">
                                    <a href="{{ $item['href'] ?? '#' }}" class="menu-link">
                                        @lang($item['title'])
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            <!--end::Header Logo-->
        </div>
        <!--end::Left-->

        <!--begin::Topbar-->
        <div class="topbar">
            <!--begin: User Bar -->
            @foreach($items as $item)
                <?php $route = $item['route'] ? route($item['route']) : '#'; ?>
                <div class="topbar-item">
                    @if($item['type'] === 'text')
                        <div class="btn btn-text-white btn-hover-text-dark-75 text-uppercase">
                            <a class="text-white" href="{{ $route }}">
                                <h3>{{ $item['title'] }}</h3>
                            </a>
                        </div>
                    @else
                        <div class="btn btn-icon mx-2 btn-hover-text-dark-75">
                            <a class="text-white" href="{{ $route }}">
                                <i class="{{ $item['icon'] ?? '' }} text-white icon-xl"></i>
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach


            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="false">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                        <img class="h-20px w-20px rounded-sm" src="{{ asset('media/svg/flags/'.$langNow['img']) }}"
                             alt="">
                    </div>
                </div>
                <!--end::Toggle-->

                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right" style="">
                    <!--begin::Nav-->
                    <ul class="navi navi-hover py-4">

                    @foreach($languages as $key => $lang)
                        <!--begin::Item-->
                            <li class="navi-item">
                                <a href="{{ route('change.language', $key) }}" class="navi-link">
                                        <span class="symbol symbol-20 mr-3">
                                            <img src="{{ asset("/media/svg/flags/".$lang['img']) }}" alt="">
                                        </span>
                                    <span class="navi-text">{{$lang['title']}}</span>
                                </a>
                            </li>
                            <!--end::Item-->
                        @endforeach

                    </ul>
                    <!--end::Nav-->
                </div>
                <!--end::Dropdown-->
            </div>


            <div class="topbar-item">
                @auth
                    <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2">
                        <div class="header-topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                            {{ auth()->user()->name }}
                            <span class="symbol symbol-30 symbol-circle symbol-light-info">
                            <span class="symbol-label font-size-h5 font-weight-bold">
                                @if(auth()->user()->image)
                                    <img src="{{ asset(auth()->user()->image) }}" alt="{{ auth()->user()->name }}">
                                @else
                                    {{ auth()->user()->name[0] ?? 'S' }}
                                @endif
                            </span>
                        </span>
                        </div>
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">

                            <!--begin: Head -->
                            <div class="d-flex flex-column bgi-size-cover bgi-no-repeat rounded-top"
                                 style="background-image: url({{ asset('media/misc/bg-1.jpg') }})">
                                <div class="d-flex align-items-center m-8">
                                    <div class="symbol symbol-40 symbol-light-primary mr-5">
                                        <span class="symbol-label">{{ auth()->user()->name[0] ?? 'S' }}</span>
                                    </div>
                                    <div class="d-flex flex-column font-weight-bold text-white">
                                        {{ auth()->user()->name }}
                                    </div>
                                </div>
                            </div>

                            <!--end: Head -->

                            <!--begin: Navigation -->
                            <div class="notification">
                                <div class="notification-custom space-between m-5">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                       class="btn btn-success btn-sm font-weight-bold btn-font-md ml-2">@lang('ttdt.logout')</a>
                                </div>
                            </div>

                            <!--end: Navigation -->
                        </div>
                    </div>
                @else
                    <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                @endauth
            </div>
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>

