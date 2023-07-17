<!DOCTYPE html>
<html lang="en">

<head>
  @include('dashboard.component.layout.head')
  <title>@yield('title', 'Dashboard') | E-modul App</title>
</head>

<body class="bg-light">
  <div id="db-wrapper">
    <!-- Sidebar -->
    @include('dashboard.component.layout.sidebar')
    <!-- / Sidebar -->

    <!-- Page content -->
    <div id="page-content">
      <div class="header @@classList">
        <!-- Navbar -->
        @include('dashboard.component.layout.navbar')
        <!-- / Navbar -->
      </div>
      <!-- Container fluid -->
      <div class="row mt-3 mx-3">
        @yield('content')
      </div>
    </div>
  </div>

    <!-- Navbar -->
        @include('dashboard.component.layout.footer')
    <!-- / Navbar -->



  <!-- Scripts -->
  @include('dashboard.component.layout.scripts')
  @yield('scripts')
</body>

</html>
