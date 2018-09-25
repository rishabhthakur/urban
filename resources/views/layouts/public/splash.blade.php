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

    <title>{{ __(getSettings()->site_name) . ' | ' . 'mode' }}</title>

    <!-- Core Styles -->
    @include('layouts.public.includes.css')
</head>
<body>
    <div id="app">
        <!-- Notifications -->
        @include('layouts.public.includes.notifications')
        <main role="main">
            <section class="section-padded-80">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 bg-secondary">
                            @yield('splash')
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

</body>
</html>
