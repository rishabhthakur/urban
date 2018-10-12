<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', getSettings()->locale) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO Meta data -->
    <meta name="author" content="{{ __(getSettings()->author) }}">
    <meta name="description" content="{{ __(getSettings()->description) }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __(getSettings()->site_name) . ' | ' . __(getSettings()->tagline) }}</title>

    <!-- Stipe JS -->
    @yield('stripe-init')

    @include('layouts.public.includes.css')
</head>
<body>
    <div id="app">
        <!-- Notifications -->
        @include('layouts.public.includes.notifications')

        <!-- ##### Header Area Start ##### -->
        @include('layouts.public.includes.header')
        <!-- ##### Header Area End ##### -->

        <!-- ##### Right Side Cart Area ##### -->
        @include('layouts.public.includes.cart')

        <main role="main">
            @yield('content')
        </main>

        <!-- ##### Footer Area Start ##### -->
        @include('layouts.public.includes.footer')
        <!-- ##### Footer Area End ##### -->

        <!-- Contact modal -->
        @yield('contact-modal')
    </div>

    @include('layouts.public.includes.js')
</body>
</html>
