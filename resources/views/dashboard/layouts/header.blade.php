
<!-- BEGIN #header -->
<div id="header" class="app-header">
    <!-- BEGIN navbar-header -->
    <div class="navbar-header">
        <a href="dashboard" class="navbar-brand"><span class="navbar-logo"></span> <b>{{__('dashboard.website_first_name')}}</b> {{__('dashboard.website_last_name')}}</a>
        <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <!-- END navbar-header -->
    <!-- BEGIN header-nav -->
    <div class="navbar-nav">
        <!-- Search  -->

        {{--<div class="navbar-item navbar-form">
            <form action="" method="POST" name="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter keyword" />
                    <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>--}}

    <!-- ./Search -->

        <!-- Notifications -->

        {{--<div class="navbar-item dropdown">
            <a href="#" data-bs-toggle="dropdown" class="navbar-link dropdown-toggle icon">
                <i class="fa fa-bell"></i>
                <span class="badge">5</span>
            </a>
            <div class="dropdown-menu media-list dropdown-menu-end">
                <div class="dropdown-header">NOTIFICATIONS (5)</div>
                <a href="javascript:;" class="dropdown-item media">
                    <div class="media-left">
                        <i class="fa fa-bug media-object bg-gray-500"></i>
                    </div>
                    <div class="media-body">
                        <h6 class="media-heading">Server Error Reports <i class="fa fa-exclamation-circle text-danger"></i></h6>
                        <div class="text-muted fs-10px">3 minutes ago</div>
                    </div>
                </a>
                <a href="javascript:;" class="dropdown-item media">
                    <div class="media-left">
                        <img src="{{ asset('admin-panel/assets/img/user/user-1.jpg') }}" class="media-object" alt="" />
                        <i class="fab fa-facebook-messenger text-blue media-object-icon"></i>
                    </div>
                    <div class="media-body">
                        <h6 class="media-heading">John Smith</h6>
                        <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                        <div class="text-muted fs-10px">25 minutes ago</div>
                    </div>
                </a>
                <a href="javascript:;" class="dropdown-item media">
                    <div class="media-left">
                        <img src="{{ asset('admin-panel/assets/img/user/user-2.jpg') }}" class="media-object" alt="" />
                        <i class="fab fa-facebook-messenger text-blue media-object-icon"></i>
                    </div>
                    <div class="media-body">
                        <h6 class="media-heading">Olivia</h6>
                        <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                        <div class="text-muted fs-10px">35 minutes ago</div>
                    </div>
                </a>
                <a href="javascript:;" class="dropdown-item media">
                    <div class="media-left">
                        <i class="fa fa-plus media-object bg-gray-500"></i>
                    </div>
                    <div class="media-body">
                        <h6 class="media-heading"> New User Registered</h6>
                        <div class="text-muted fs-10px">1 hour ago</div>
                    </div>
                </a>
                <a href="javascript:;" class="dropdown-item media">
                    <div class="media-left">
                        <i class="fa fa-envelope media-object bg-gray-500"></i>
                        <i class="fab fa-google text-warning media-object-icon fs-14px"></i>
                    </div>
                    <div class="media-body">
                        <h6 class="media-heading"> New Email From John</h6>
                        <div class="text-muted fs-10px">2 hour ago</div>
                    </div>
                </a>
                <div class="dropdown-footer text-center">
                    <a href="javascript:;" class="text-decoration-none">View more</a>
                </div>
            </div>
        </div>--}}

    <!-- Notifications -->


        <div class="navbar-item navbar-user dropdown">
            <a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                <img src="{{ auth('admin')->user()->image }}" alt="" />
                <span>
                    <span class="d-none d-md-inline">{{auth('admin')->user()->name}}</span>
                    <b class="caret"></b>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end me-1">
                <a href="{{route('index')}}" class="dropdown-item" target="_blank">View Website</a>
                <a href="settings" class="dropdown-item">Settings</a>
                <div class="dropdown-divider"></div>
                <a href="{{route('dashboard.logout')}}" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
    <!-- END header-nav -->
</div>
<!-- END #header -->
