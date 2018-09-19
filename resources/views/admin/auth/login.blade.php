@extends('layouts.admin.auth')

@section('content')
    <div class="container pt-lg-md">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-white">
                        <div class="text-muted text-center py-3">
                            <a href="#" class="navbar-brand m-0">
                                <img src="{!! asset('img/logo-black.png') !!}" alt="">
                            </a>
                            <div class="d-block">
                                <small>Sign in with staff credentials</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email address">
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
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
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
                                <a href="{{ route('password.request') }}" class="text-muted float-right mt-1">
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
@endsection
