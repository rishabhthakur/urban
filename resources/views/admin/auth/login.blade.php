@extends('layouts.admin.auth')

@section('content')
    <div class="container pt-lg-md">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card border-0 bg-transparent">
                    <div class="card-body">
                        <div class="text-muted text-center mt-3">
                            <a href="#" class="navbar-brand m-0">
                                <img src="{!! asset('img/logo-black.png') !!}" alt="">
                            </a>
                            <div class="d-block">
                                <small>Sign in with staff credentials</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-3">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <input type="hidden" name="admin" value="1">

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus placeholder="Email address">
                                </div>

                                @if ($errors->has('email'))
                                    <span class="text-danger form-text" role="alert">
                                        <small><strong>{{ $errors->first('email') }}</strong></small>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                                </div>

                                @if ($errors->has('password'))
                                    <span class="text-danger form-text" role="alert">
                                        <small><strong>{{ $errors->first('password') }}</strong></small>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">
                                        <span>Remember me</span>
                                    </label>
                                    <a href="#" class="text-muted float-right mt-1" data-toggle="modal" data-target="#exampleModal">
                                        <small>Forgot password?</small>
                                    </a>
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button type="submit" class="btn btn-primary mt-4">
                                    {{ __('Sign in') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h6>Forgot Your Password?</h6>
                    <p>
                        Enter the e-mail address associated with your account. Click submit to have a password reset link e-mailed to you.
                    </p>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('Email Address') }}</label>

                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email Address" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send Password Reset Link') }}
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                {{ __('Cancel') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
