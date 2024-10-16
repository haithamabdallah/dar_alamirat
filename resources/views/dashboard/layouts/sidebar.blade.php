<!-- BEGIN #
    idebar -->
<div id="sidebar"
    class="app-sidebar {{ session()->has('darkMode') && session('darkMode') == true ? '' : 'bg-white ' }}">
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <!-- BEGIN menu -->
        <div class="menu">
            <div class="menu-profile">
                <a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile"
                    data-target="#appSidebarProfileMenu">
                    <div class="menu-profile-cover with-shadow"></div>
                    <div class="menu-profile-image">
                        <img src="{{ auth('admin')->user()->image }}" alt="" />
                    </div>
                    <div class="menu-profile-info">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                {{ auth('admin')->user()->name }}
                            </div>
                            <div class="menu-caret ms-auto"></div>
                        </div>
                        {{-- <small>{{ auth('admin')->user()->roles()->first()->name }}</small> --}}
                    </div>
                </a>
            </div>
            <div class="menu-header">Navigation</div>

            <!-- items with childs -->
            @php

                $adminPermissionNames = auth('admin')->user()?->role?->permissions?->pluck('name')->toArray();

                $itemsWithChilds = [
                    [
                        'isVisible' =>
                            in_array('Admins', $adminPermissionNames) || in_array('Roles', $adminPermissionNames),
                        'isActive' => activeLink('roles') ?? activeLink('admin'),
                        'iconClasses' => 'fa-solid fa-users',
                        'name' => __('dashboard.administrator'),
                        'childs' => [
                            [
                                'isVisible' => in_array('Admins', $adminPermissionNames),
                                'isActive' => activeLink('admin'),
                                'href' => route('admin.index'),
                                'name' => __('dashboard.admins'),
                            ],
                            [
                                'isVisible' => in_array('Roles', $adminPermissionNames),
                                'isActive' => activeLink('roles'),
                                'href' => route('roles.index'),
                                'name' => __('dashboard.roles'),
                            ],
                        ],
                    ],
                ];
            @endphp

            @foreach ($itemsWithChilds as $item)
                @if ($item['isVisible'])
                    <!-- item -->
                    <div class="menu-item has-sub {{ $item['isActive'] }}">
                        <a href="javascript:;" class="menu-link">
                            <div class="menu-icon">
                                <i class="{{ $item['iconClasses'] }}"></i>
                            </div>
                            <div class="menu-text">{{ $item['name'] }}</div>
                            <div class="menu-caret"></div>
                        </a>
                        <div class="menu-submenu">
                            @foreach ($item['childs'] as $childItem)
                                @if ($childItem['isVisible'])
                                    <div class="menu-item {{ $childItem['isActive'] }}">
                                        <a href="{{ $childItem['href'] }}" class="menu-link">
                                            <div class="menu-text">{{ $childItem['name'] }}</div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <!-- ./item -->
                @endif
            @endforeach

            <!-- items without childs -->

            @php

                $items = [
                    [
                        'isVisible' => in_array('Statistics', $adminPermissionNames),
                        'isActive' => activeSingleLink('dashboard.index'),
                        'href' => 'dashboard',
                        'iconClasses' => 'fa-solid fa-house',
                        'name' => 'Statistics',
                    ],
                    [
                        'isVisible' => in_array('Orders', $adminPermissionNames),
                        'isActive' => activeLink('order'),
                        'href' => route('order.index'),
                        'iconClasses' => 'fa-solid fa-cart-arrow-down',
                        'name' => 'Orders',
                    ],
                    [
                        'isVisible' => in_array('Categories', $adminPermissionNames),
                        'isActive' => activeLink('category'),
                        'href' => route('category.index'),
                        'iconClasses' => 'fa-solid fa-book',
                        'name' => 'Categories',
                    ],
                    [
                        'isVisible' => in_array('Brands', $adminPermissionNames),
                        'isActive' => activeLink('brand'),
                        'href' => route('brand.index'),
                        'iconClasses' => 'fa-solid fa-sitemap',
                        'name' => 'Brands',
                    ],
                    [
                        'isVisible' => in_array('Shipping', $adminPermissionNames),
                        'isActive' => activeLink('shipping'),
                        'href' => route('shipping.index'),
                        'iconClasses' => 'fa-solid fa-bicycle',
                        'name' => 'Shipping',
                    ],
                    [
                        'isVisible' => in_array('Products', $adminPermissionNames),
                        'isActive' => activeLink('product'),
                        'href' => route('product.index'),
                        'iconClasses' => 'fa-solid fa-store',
                        'name' => 'Products',
                    ],
                    [
                        'isVisible' => in_array('Coupons', $adminPermissionNames),
                        'isActive' => activeLink('dashboard.coupons'),
                        'href' => route('dashboard.coupons.index'),
                        'iconClasses' => 'fa-solid fa-dollar',
                        'name' => 'Coupons',
                    ],
                    [
                        'isVisible' => in_array('Sliders', $adminPermissionNames),
                        'isActive' => activeLink('dashboard.slider'),
                        'href' => route('dashboard.slider.index'),
                        'iconClasses' => 'fa-solid fa-images',
                        'name' => 'Sliders',
                    ],
                    [
                        'isVisible' => in_array('Pages', $adminPermissionNames),
                        'isActive' => activeLink('page'),
                        'href' => route('page.index'),
                        'iconClasses' => 'fa-solid fa-newspaper',
                        'name' => 'Static Pages',
                    ],
                    [
                        'isVisible' => in_array('Subscribers', $adminPermissionNames),
                        'isActive' => activeLink('subscription') ?? activeLink('subscriber'),
                        'href' => route('subscription.index'),
                        'iconClasses' => 'fa-solid fa-message',
                        'name' => 'Subscribers',
                    ],
                    [
                        'isVisible' => in_array('Banners', $adminPermissionNames),
                        'isActive' => activeLink('banner'),
                        'href' => route('banner.index'),
                        'iconClasses' => 'fa-solid fa-image',
                        'name' => 'Banners',
                    ],
                    [
                        'isVisible' => in_array('Index Page Priority Settings', $adminPermissionNames),
                        'isActive' => request()->routeIs('index.priority') ? 'active' : '',
                        'href' => route('index.priority'),
                        'iconClasses' => 'fa-solid fa-gear',
                        'name' => 'Index Page Priority Settings',
                    ],
                    [
                        'isVisible' => in_array('Settings', $adminPermissionNames),
                        'isActive' => activeLink('setting'),
                        'href' => route('settings.index'),
                        'iconClasses' => 'fa-solid fa-gear',
                        'name' => 'Settings',
                    ],
                ];
            @endphp

            @foreach ($items as $item)
                @if ($item['isVisible'])
                    <!-- item -->
                    <div class="menu-item {{ $item['isActive'] }}">
                        <a href="{{ $item['href'] }}" class="menu-link">
                            <div class="menu-icon">
                                <i class="{{ $item['iconClasses'] }}"></i>
                            </div>
                            <div class="menu-text"> {{ $item['name'] }}</div>
                        </a>
                    </div>
                    <!-- ./item -->
                @endif
            @endforeach

            <!-- BEGIN minify-button -->
            <div class="menu-item d-flex">
                <a href="javascript:;"
                    class="app-sidebar-minify-btn ms-auto d-flex align-items-center text-decoration-none"
                    data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
            </div>
            <!-- END minify-button -->
        </div>
        <!-- END menu -->
    </div>
    <!-- END scrollbar -->
</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a>
</div>
<!-- END #sidebar -->
