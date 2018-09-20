@extends('layouts.public.app')

@section('content')
<section class="section section-padded-80">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h5 class="mb-0">Forgot Your Password?</h5>
                <hr>
                <p>
                    Enter the e-mail address associated with your account. Click submit to have a password reset link e-mailed to you.
                </p>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email Address" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                </form>
                <div class="mt-4">
                    <a href="{!! route('login') !!}">< Go back</a>
                </div>
            </div>
            <div class="col-md-2 offset-md-2">
                <h5>Quick Links</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{!! route('register') !!}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{!! route('password.request') !!}">Forgot Password?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Privacy Policy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Terms &amp; Conditions</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
