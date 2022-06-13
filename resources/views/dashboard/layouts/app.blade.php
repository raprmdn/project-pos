<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name') }} - @yield('title')</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('dashboardpage/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboardpage/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboardpage/bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboardpage/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboardpage/dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  @yield('css')
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    @include('dashboard.layouts.header')
    @include('dashboard.layouts.sidebar')

    <div class="content-wrapper">

      <section class="content-header">
        <h1>
          @yield('title')
        </h1>
        <ol class="breadcrumb">
          @section('breadcrumb')
            <li><a href="{{ route('index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('dashboard') }}">@yield('title')</a></li>
          @show
        </ol>
      </section>

      <section class="content">
        @yield('content')
      </section>

    </div>

    @include('dashboard.layouts.footer')
  </div>

  <script src="{{ asset('dashboardpage/bower_components/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('dashboardpage/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('dashboardpage/dist/js/adminlte.min.js') }}"></script>
  <script src="{{ asset('dashboardpage/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ asset('dashboardpage/bower_components/fastclick/lib/fastclick.js') }}"></script>
  @stack('scripts')

</body>

</html>
