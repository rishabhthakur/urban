<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    <script src="https://js.stripe.com/v3/"></script>

    <!-- Core Styles -->
    @include('layouts.public.includes.css')
</head>
<body class="mt-0">
    <div id="app">
        <!-- Notifications -->
        @include('layouts.public.includes.notifications')

        <main role="main">
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <div class="row justify-content-center">
                        <div class="col-8 h-100vh d-flex align-items-center">
                            <div class="info">
                                <!-- Logo -->
                                <a class="nav-brand" href="{!! route('home') !!}">
                                    <img src="{!! asset('img/logo-black.png') !!}" alt="" height="30px">
                                </a>
                                <div class="mt-3">
                                    @yield('splash')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('layouts.public.includes.js')
</body>
</html>
