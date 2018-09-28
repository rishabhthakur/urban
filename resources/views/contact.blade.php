@extends('layouts.public.app')

@section('content')
    <div class="contact-area d-flex align-items-center">

        <div class="google-map h-100">
            <div id="googleMap"></div>
        </div>

        <div class="contact-info">
            <h2>How to Find Us</h2>
            <p>Mauris viverra cursus ante laoreet eleifend. Donec vel fringilla ante. Aenean finibus velit id urna vehicula, nec maximus est sollicitudin.</p>

            <div class="contact-address mt-50">
                <p><span>address:</span> 10 Suffolk st Soho, London, UK</p>
                <p><span>telephone:</span> +12 34 567 890</p>
                <p><span>Email:</span> <a href="mailto:contact@essence.com">contact@fabraco.com</a></p>
                <p></p>
                <a href="#" class="btn btn-primary mt-4" data-toggle="modal" data-target=".bd-example-modal-lg">Send Us a Message</a>
            </div>
        </div>

    </div>
@endsection

@section('contact-modal')
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-5">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
                <h5>Send Us A Message </h5>
                <div class="my-5"></div>
                <form class="mt-3" action="{!! route('contact.store') !!}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <div class="col">
                            <label for="first_name">First Name <span class="text-danger">*</span></label>
                            <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" @if (Auth::check()) value="{{ Auth::user()->profile->first_name }}" @else value="{{ old('first_name') }}" @endif placeholder="First Name" required>

                            @if ($errors->has('first_name'))
                                <span class="text-danger form-text" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col">
                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                            <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" @if (Auth::check()) value="{{ Auth::user()->profile->last_name }}" @else value="{{ old('last_name') }}" @endif placeholder="Last Name" required>

                            @if ($errors->has('last_name'))
                                <span class="text-danger form-text" role="alert">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address <span class="text-danger">*</span></label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" @if (Auth::check()) value="{{ Auth::user()->email }}" @else value="{{ old('email') }}" @endif placeholder="Email address" required>

                        @if ($errors->has('email'))
                            <span class="text-danger form-text" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input id="subject" type="text" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" value="{{ old('subject') }}" placeholder="Subject" required>

                        @if ($errors->has('subject'))
                            <span class="text-danger form-text" role="alert">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="message">How can we help you? <span class="text-danger">*</span></label>
                        <textarea name="message" class="form-control" placeholder="What would you like to talk about?" style="height: 150px">{{ old('message') }}</textarea>
                        @if ($errors->has('message'))
                            <span class="text-danger form-text" role="alert">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group mt-5 mb-0">
                        <button type="submit" class="btn btn-dark btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('map-js')
    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwuyLRa1uKNtbgx6xAJVmWy-zADgegA2s"></script>
    <script src="js/map-active.js"></script>
@endsection
