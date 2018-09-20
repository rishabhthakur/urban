@extends('layouts.public.app')

@section('content')
    <div class="contact-area d-flex align-items-center">

        <div class="google-map">
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
                <div class="mt-50">
                    <h5>Send Us A Message </h5>
                    <hr>
                    <form class="mb-5 mt-3" action="index.html" method="post">
                        <div class="form-group">
                            <label for="">Email Address</label>
                            <input type="text" name="" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <label for="">How can we help you?</label>
                            <textarea name="name" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                        <button type="button" class="btn btn-dark btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
