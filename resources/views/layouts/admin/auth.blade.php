<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin/app.js') }}" defer></script>

    <!-- Styles -->
    @include('layouts.admin.includes.css')
</head>
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @include('layouts.admin.includes.js')
</body>
</html>
