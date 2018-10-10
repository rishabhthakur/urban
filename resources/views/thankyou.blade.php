@extends('layouts.public.splash')

@section('splash')
    <h1 class="display-1">
        Thank You!
    </h1>
    <h3>
        Thank You for Your Order!
    </h3>
    <p>
        Your order was confirmed and is pending shippment. A confirmation email has been sent to you.
    </p>
    <p>
        <a href="{!! route('home') !!}" class="btn btn-primary">Go back</a>
        <a href="{!! route('shop') !!}" class="btn btn-outline-primary">Continue Shopping</a>
    </p>
@endsection
