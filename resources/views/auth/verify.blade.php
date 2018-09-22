@extends('layouts.public.app')

@section('content')
<section class="section-padded-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 text-center">
                <h5 class="mb-4">{{ __('Verify Your Email Address') }}</h5>

                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                <p>
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
