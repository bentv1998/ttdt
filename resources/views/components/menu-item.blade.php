<li class="menu-item
    @if (isset($children))
        @foreach ($children as $child)
            @if (Route::current() == $child['link'])
                menu-item-open menu-item-here
            @endif
        @endforeach
    @endif
    {{ $route && Route::current() == route($route) ? ' menu-item-active' : '' }}
    {{ isset($children) && !empty($children) ? ' menu-item-submenu' : '' }}" aria-haspopup="true">
    <a href="{{ $route ? route($route) : 'javascript:;' }}" class="menu-link">
        <span class="menu-icon">
            <i class="{{ $icon ?? 'menu-bullet menu-bullet-dot' }}"></i>
        </span>
        <span class="menu-text">{{ $slot }}</span>
        @if (isset($children))
        <i class="menu-ver-arrow la la-angle-right"></i>
        @endif
    </a>
    @if (isset($children))
    <div class="menu-submenu ">
        <span class="menu-arrow"></span>
        <ul class="menu-subnav">
            <li class="menu-item menu-item-parent" aria-haspopup="true">
                <span class="menu-link">
                    <span class="menu-link-text">{{ $slot }}</span>
                </span>
            </li>
            @foreach ($children as $child)
                <x-menu-item
                        isActive="{{ $child['isActive'] ?? false }}"
                        link="{{ $child['link'] ?? '' }}">
                    <x-slot name="children">
                        {{ $child['children'] }}
                    </x-slot>
                    {{ $child['slot'] }}
                </x-menu-item>
            @endforeach
        </ul>
    </div>
    @endif
</li>
