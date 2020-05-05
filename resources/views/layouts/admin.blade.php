<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>@yield('title', config('app.name', 'Laravel'))</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="@yield('title', config('app.name', 'Laravel'))"  />
        <meta name="keywords" content="@yield('title', config('app.name', 'Laravel'))"  />
        <meta name="author" content="Themesbrand"  />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('assets/admin/images/favicon.ico') }}">
        
        @section('styles')
            <link href="{{ url('assets/admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
            <link href="{{ url('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ url('assets/admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        @show

    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            @include('admin/includes/header')

            <!-- ========== Left Sidebar Start ========== -->
            @include('admin/includes/sidebar_left')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    @section('content')
                    @show
                </div>
                <!-- End Page-content -->


                
                @include('admin/includes/errors')
                @include('admin/includes/footer')

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        @include('admin/includes/sidebar_right')
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        
        @section('scripts')
        <script src="{{ url('assets/admin/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ url('assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('assets/admin/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ url('assets/admin/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ url('assets/admin/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ url('assets/admin/js/app.js') }}"></script>
        @show
        
    </body>
</html>