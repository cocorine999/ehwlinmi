<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('dashboard/dist/css/adminlte.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  @toastr_css
  @yield('styles')
  <style>
    div.content-wrapper {
      /* background-image: url("logotr.png"); */
      background-position: center;
      background-repeat: no-repeat;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="#" class="brand-link">
        <img src="{{ asset('logo.jpeg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name')}}</span>
      </a>

      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('dashboard/dist/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="{{ route('utilisateurs.profil') }}" class="d-block">{{Auth::user()->shortFullname}}</a>
            </hr>
            <h6 class="text-white"> {{ Auth::user()->getRoleNames()[0] }}</h6>
          </div>

        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @include("layouts.partials._sidebar")
          </ul>
        </nav>
      </div>
    </aside>

    <div class="content-wrapper">

      <section class="content-header">

        <div class="container-fluid">
          <div class="row mb-2">

            <div class="col-12">

              <h1>@yield('pagetitle')</h1>
            </div>
          </div>
        </div>
      </section>

      @include("layouts.partials._messages")
      <section class="content">

        @yield('content')

      </section>
    </div>

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block"><b>Version</b> 1.0</div>
      <strong>&copy; <script>
          document.write(new Date().getFullYear());
        </script> <a href="/">{{config('app.name')}}</a></strong>
    </footer>

    <aside class="control-sidebar control-sidebar-dark"></aside>
  </div>

  <script src="{{ asset('dashboard/plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('dashboard/dist/js/adminlte.min.js') }}"></script>
  <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
  <script>
    $(function () {
  $("table").DataTable({
    "aaSorting": [],
    "language": {
      url: "dashboard/plugins/datatables-bs4/french.json"
      }
  });
});
  </script>

  @toastr_js
  @toastr_render

  @yield('js')
</body>

</html>
