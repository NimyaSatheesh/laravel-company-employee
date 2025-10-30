<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('assets/admin/dist/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin.layouts.navigation')
        @include('admin.layouts.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/admin/dist/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/js/adminlte.js') }}"></script>

    @stack('scripts')
</body>
</html>
