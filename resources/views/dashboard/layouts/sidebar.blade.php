<!-- BEGIN #sidebar -->
<div id="sidebar" class="app-sidebar">
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <!-- BEGIN menu -->
        <div class="menu">
            <div class="menu-profile">
                <a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile" data-target="#appSidebarProfileMenu">
                    <div class="menu-profile-cover with-shadow"></div>
                    <div class="menu-profile-image">
                        <img src="{{ auth('admin')->user()->image}}" alt="" />
                    </div>
                    <div class="menu-profile-info">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                {{auth('admin')->user()->name}}
                            </div>
                            <div class="menu-caret ms-auto"></div>
                        </div>
                        <small>{{auth('admin')->user()->roles()->first()->name}}</small>
                    </div>
                </a>
            </div>
            <div id="appSidebarProfileMenu" class="collapse">
                <div class="menu-item pt-5px">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon"><i class="fa fa-cog"></i></div>
                        <div class="menu-text">Settings</div>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon"><i class="fa fa-pencil-alt"></i></div>
                        <div class="menu-text"> Send Feedback</div>
                    </a>
                </div>
                <div class="menu-item pb-5px">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon"><i class="fa fa-question-circle"></i></div>
                        <div class="menu-text"> Helps</div>
                    </a>
                </div>
                <div class="menu-divider m-0"></div>
            </div>
            <div class="menu-header">Navigation</div>
            <!-- item -->
            <div class="menu-item {{ activeSingleLink('dashboard.index') }}">
                <a href="/dashboard" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="menu-text">Statistics</div>
                </a>
            </div>
            <!-- ./item -->

            <!-- item -->
            <div class="menu-item has-sub {{ activeLink('roles') }} {{ activeLink('admin') }}">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="menu-text">{{__('dashboard.administrator')}}</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item {{ activeLink('admin') }}">
                        <a href="{{route('admin.index')}}" class="menu-link">
                            <div class="menu-text">{{__('dashboard.admins')}}</div>
                        </a>
                    </div>
                    <div class="menu-item {{ activeLink('roles') }}">
                        <a href="{{route('roles.index')}}" class="menu-link">
                            <div class="menu-text">{{__('dashboard.roles')}}</div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ./item -->

            <!-- item -->
            <div class="menu-item {{ activeLink('product') }}">
                <a href="{{route('product.index')}}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-store"></i>
                    </div>
                    <div class="menu-text">Products</div>
                </a>
            </div>
            <!-- ./item -->

            <!-- item -->
            <div class="menu-item {{ activeLink('shipping') }}">
                <a href="{{route('shipping.index')}}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-store"></i>
                    </div>
                    <div class="menu-text">Shippings</div>
                </a>
            </div>
            <!-- ./item -->

            <!-- item -->
            <div class="menu-item">
                <a href="{{ route('order.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-cart-arrow-down"></i>
                    </div>
                    <div class="menu-text">Orders</div>
                </a>
            </div>
            <!-- ./item -->
            <!-- item -->
            <div class="menu-item {{ activeLink('category') }}">
                <a href="{{route('category.index')}}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-sitemap"></i>
                    </div>
                    <div class="menu-text">{{__('dashboard.categories')}}</div>
                </a>
            </div>
            <!-- ./item -->
            <!-- item -->
            <div class="menu-item {{ activeLink('brand') }}">
                <a href="{{route('brand.index')}}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-sitemap"></i>
                    </div>
                    <div class="menu-text">{{__('dashboard.brands')}}</div>
                </a>
            </div>
            <!-- ./item -->

            <!-- item -->
            <div class="menu-item">
                <a href="{{ route('client.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="menu-text">Clients</div>
                </a>
            </div>
            <!-- ./item -->

            <!-- item -->
            <div class="menu-item">
                <a href="/dashboard/reports" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-chart-pie"></i>
                    </div>
                    <div class="menu-text">Reports</div>
                </a>
            </div>
            <!-- ./item -->

            <!-- item -->
            <div class="menu-item">
                <a href="{{ route('page.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-regular fa-newspaper"></i>
                    </div>
                    <div class="menu-text">Pages</div>
                </a>
            </div>
            <!-- ./item -->

            <!-- item -->
            <div class="menu-item">
                <a href="/dashboard/settings" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-gear"></i>
                    </div>
                    <div class="menu-text">Settings</div>
                </a>
            </div>
            <!-- ./item -->


            <!-- BEGIN minify-button -->
            <div class="menu-item d-flex">
                <a href="javascript:;" class="app-sidebar-minify-btn ms-auto d-flex align-items-center text-decoration-none" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
            </div>
            <!-- END minify-button -->
        </div>
        <!-- END menu -->
    </div>
    <!-- END scrollbar -->
</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>
<!-- END #sidebar -->
