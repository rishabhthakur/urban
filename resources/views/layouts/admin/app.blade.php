<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
        <div id="content">
            <!-- Navbar -->
            @include('layouts.admin.includes.nav')
            @include('layouts.admin.includes.notifications')

            <!-- Main content area -->
            <main role="main">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card border-0 bg-transparent">
                            <div class="card-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>
    <!-- Primary JS files -->
    @include('layouts.admin.includes.js')
</body>
</html>
