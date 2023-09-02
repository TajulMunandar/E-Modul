<!DOCTYPE html>
<html lang="en">

<head>
    @include('main.component.head')
    <title>E-Modul</title>
</head>

<body style="background-color: #DDE6ED">
    @include('main.component.navbar')
    <div class="body-content">
        @yield('content')
    </div>

    @include('main.component.script')

    <script>
        @yield('script')
    </script>
</body>

</html>
