<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', getSettings()->locale) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Dashboard</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Styles -->
    @include('layouts.admin.includes.css')
</head>
<body>
    <div id="app" class="d-flex">
        <!-- Sidebar  -->
        @include('layouts.admin.includes.sidebar')
        <!-- Page Content  -->
        <div id="content" class="">
            <!-- Navbar -->
            @include('layouts.admin.includes.nav')

            <!-- Main content area -->
            <main role="main">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>

        </div>
    </div>
    <!-- Notification banners -->
    @include('layouts.admin.includes.notifications')
    <!-- Primary JS files -->
    @include('layouts.admin.includes.js')
</body>
</html>
