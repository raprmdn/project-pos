<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/fontawesome-free/css/all.min.css') }}">
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('dashboardpage/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('dashboard.layouts.header')
    @include('dashboard.layouts.sidebar')

    <div class="content-wrapper">
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @section('breadcrumb')
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            @show
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

    @include('dashboard.layouts.footer')

</div>
<script src="{{ asset('dashboardpage/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dashboardpage/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dashboardpage/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('dashboardpage/dist/js/adminlte.min.js') }}"></script>
@stack('scripts')
</body>

</html>
