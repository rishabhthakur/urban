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
                <form class="mt-3" action="index.html" method="post">
                    <div class="form-group">
                        <label for="">Email Address</label>
                        <input type="text" name="" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <label for="">How can we help you?</label>
                        <textarea name="name" class="form-control" placeholder="Explain to us in a few words."></textarea>
                    </div>
                    <div class="form-group mt-5 mb-0">
                        <button type="button" class="btn btn-dark btn-block">Submit</button>
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
