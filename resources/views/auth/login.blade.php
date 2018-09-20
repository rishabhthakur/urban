@extends('layouts.public.app')

@section('content')
<section class="section section-padded-80">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">New Customer</h5>
                    </div>
                    <div class="card-body">
                        <h6>Register</h6>
                        <p>
                            By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.
                        </p>
                        @if (getSettings()->membership)
                            <a href="{!! route('register') !!}" class="btn btn-primary mt-3">Continue</a>
                        @else
                            <span class="text-danger">New registrations are not accepted anymore.</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Returning Customer</h5>
                    </div>

                    <div class="card-body">
                        <p>
                            I am a returning customer.
                        </p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email">{{ __('Email address') }}</label>

                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email address" required>

                                @if ($errors->has('email'))
                                    <span class="text-danger form-text" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="text-danger form-text" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">
                                        <span>Remember me</span>
                                    </label>
                                    <a href="{{ route('password.request') }}" class="text-muted float-right mt-1">
                                        Forgot password?
                                    </a>
                                </div>
                            </div>

                            <div class="form-group mt-5 mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
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
