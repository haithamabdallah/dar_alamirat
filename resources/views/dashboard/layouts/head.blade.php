<head>
    @yield('meta')
    <!-- ================== BEGIN core-css ================== -->
    <link href="{{ asset('admin-panel/assets/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin-panel/assets/css/default/app.min.css') }}" rel="stylesheet" />
    <!-- ================== END core-css ================== -->

    <!-- ================== BEGIN page-css ================== -->
    <link href="{{asset('admin-panel/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin-panel/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin-panel/assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin-panel/assets/plugins/datatables.net-colreorder-bs5/css/colReorder.bootstrap5.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin-panel/assets/plugins/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin-panel/assets/plugins/datatables.net-rowreorder-bs5/css/rowReorder.bootstrap5.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin-panel/assets/plugins/datatables.net-select-bs5/css/select.bootstrap5.min.css')}}" rel="stylesheet" />
    <!-- ================== END page-css ================== -->
    @yield('customcss')
</head>
