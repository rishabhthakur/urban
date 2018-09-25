@extends('layouts.public.app')

@section('content')
<section class="section section-padded-80">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="mb-4">
                    <h5>Reset Password</h5>
                    <hr>
                    <p>
                        Make sure to choose a secure password or use our password generator if you are unsure about how to make a strong password.</a>.
                    </p>
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>

                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="Email Address" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="New Password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-8">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-dark">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2 offset-md-2">
                <h5>Quick Links</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{!! route('register') !!}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{!! route('login') !!}">Login</a>
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
