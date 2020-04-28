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
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        
        @section('styles')
        <link href="{{ url('assets/admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        @show
    </head>

    <body data-sidebar="dark">
        
        @section('content')
        @show
    </body>

</html>