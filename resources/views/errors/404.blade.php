@extends('layouts.public.splash')

@section('splash')
    <h1 class="display-1">
        404
    </h1>
    <h3>
        Page not found
    </h3>
    <p>
        We can't seem to find the page you're looking for.
    </p>
    <p>
        <a href="{!! route('home') !!}" class="btn btn-primary">Go back</a>
    </p>
@endsection
