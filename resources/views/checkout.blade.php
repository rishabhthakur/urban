@extends('layouts.public.app')

@section('stripe-init')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Checkout Area Start ##### -->
    <div class="checkout_area section-padding-80">
        <form class="d-inline" action="{!! route('checkout.pay') !!}" method="post" enctype="multipart/form-data" id="payment-form">
            <div class="container">
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="checkout_details_area clearfix">

                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12 mb-3">
                                <h5 class="mb-4">Your Personal Details</h5>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="first_name">First Name <span>*</span></label>
                                        <input type="text" class="form-control" id="first_name" value="{{ Auth::user()->profile->first_name }}" name="first_name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="last_name">Last Name <span>*</span></label>
                                        <input type="text" class="form-control" id="last_name" value="{{ Auth::user()->profile->last_name }}" name="last_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="email">Email Address <span>*</span></label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}" placeholder="Email Address" readonly>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="company">Company Name</label>
                                        <input type="text" class="form-control" id="company" value="" name="company" placeholder="Company Name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone">Telephone <span>*</span></label>
                                        <input type="number" class="form-control" id="phone" name="phone" min="0" value="{{ Auth::user()->profile->phone }}" placeholder="Telephone">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <h5 class="mb-4">Billing Address</h5>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="address">Address <span>*</span></label>
                                <input type="text" class="form-control mb-3" id="address1" name="address1" value="{{ $bill->address1 }}" placeholder="Street Address, P.O. box">
                                <input type="text" class="form-control" id="address2" name="address2" value="{{ $bill->address12 }}" placeholder="Apartment, suite, unit, building, floor, etc,">
                            </div>
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="postcode">Postcode <span>*</span></label>
                                        <input type="text" class="form-control" id="postcode" name="postcode" value="{{ $bill->postcode }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="city">Town/City <span>*</span></label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{ $bill->town_city }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="state">Province <span>*</span></label>
                                        <input type="text" class="form-control" id="state" name="state" value="{{ $bill->province_state }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="country">Country <span>*</span></label>
                                        <select class="w-100" id="country" name="country">
                                            <option selected value="{{ $bill->country }}">{{ $bill->country }}</option>
                                            <option value="usa">United States</option>
                                            <option value="uk">United Kingdom</option>
                                            <option value="ger">Germany</option>
                                            <option value="fra">France</option>
                                            <option value="ind">India</option>
                                            <option value="aus">Australia</option>
                                            <option value="bra">Brazil</option>
                                            <option value="cana">Canada</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-5">
                                <h6>Address Accuracy</h6>
                                <p>
                                    Make sure you get your stuff! If the address is not entered correctly, your package may be returned as undeliverable. You would then have to place a new order. Save time and avoid frustration by entering the address information in the appropriate boxes and double-checking for typos and other errors.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Your Order</h5>
                            <p>The Details</p>
                        </div>

                        <ul class="order-details-form mb-5">
                            <li><span>Product</span> <span>Total</span></li>
                            @forelse (Cart::getContent() as $item)
                                <li><span>{{ $item->name }}</span> <span>${{ $item->price }} x {{ $item->quantity }}</span></li>
                            @empty
                                <li><span>No items in cart</span></li>

                            @endforelse
                            <li><span>Subtotal</span> <span>${{ Cart::getSubTotal() }}</span></li>
                            <li><span>Shipping</span> <span>Free</span></li>
                            <li><span>Total </span>
                                <span class="h5 pt-2">
                                    <strong>${{ Cart::getTotal() }}</strong>
                                </span>
                            </li>
                        </ul>

                        <div class="mt-5">
                            <div class="form-group">
                                <label for="">Have a Coupon Code?</label>
                                <div class="coupon_input_container">
                                    <input type="text" name="coupon" class="form-control border-0" placeholder="Apply Coupon">
                                    <button type="submit" class="submit_btn">
                                        <i aria-hidden="true" class="fa fa-long-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 mt-5">
                            <h5 class="mb-4">Pay with stripe</h5>
                            <p class="text-muted">
                                Pay with your credit card via Stripe.
                            </p>
                            <div class="mt-3">
                                <div class="form-group">
                                    <label for="name_on_card">Name on Card</label>
                                    <input type="text" name="name_on_card" id="name_on_card" class="form-control" placeholder="Name on Card" required>
                                </div>

                                <div class="form-group">
                                    <label for="card-element">
                                        Credit or Debit Card
                                    </label>
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                </div>

                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                        </div>

                        <div class="text-muted mb-4">
                            <small>
                                Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.
                            </small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- ##### Checkout Area End ##### -->
@endsection

@section('stripe-js')
  <!-- Stripe JS -->
  <script type="text/javascript">
    // Create a Stripe client.
    var stripe = Stripe('pk_test_FWx9UXw0Vz85nFoGptGxcad4');
    // Create an instance of Elements.
    var elements = stripe.elements();
    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#495057',
            lineHeight: '18px',
            fontFamily: '"Poppins", "Helvetica Neue", Helvetica, sans-serif',
            fontSize: '16px',
        },
        invalid: {
            color: '#f5365c',
            iconColor: '#f5365c'
        }
    };
    // Create an instance of the card Element.
    var card = elements.create('card', {
        hidePostalCode: true,
        style: style
    });
    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');
    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
    });
    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        var options = {
            name: document.getElementById('name_on_card'),
            address_line1: document.getElementById('address1'),
            address_line2: document.getElementById('address2'),
            address_city: document.getElementById('city'),
            address_state: document.getElementById('state'),
            address_zip: document.getElementById('postcode')
        }
        stripe.createToken(card, options).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        // Submit the form
        form.submit();
    }
  </script>
@endsection
