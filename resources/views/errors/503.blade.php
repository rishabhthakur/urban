@extends('layouts.public.splash')

@section('splash')
    <h1>
        Under Maintenance
    </h1>
    <p>
        Our website is currently undergoing scheduled maintenance. We Should be back shortly. Thank you for your patience.
    </p>
    <p>
        <form class="" action="index.html" method="post">
            <div class="form-group">
                <span class="text-muted">
                    <small>
                        Subscribe to our newsletter and we will send you a notification when we are back online.
                    </small>
                </span>
            </div>
            <div class="form-group mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email Address">
            </div>
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </p>
@endsection
