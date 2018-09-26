@extends('layouts.public.splash')

@section('splash')
    <h1 class="display-1">
        400
    </h1>
    <h3>
        Bad request
    </h3>
    <p>
        Our website is currently undergoing scheduled maintenance. We Should be back shortly. Thank you for your patience.
    </p>
    <p>
        <a href="{!! route('home') !!}" class="btn btn-primary">Go back</a>
    </p>
@endsection
