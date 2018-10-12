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
                                        @if ($errors->has('first_name'))
                                            <span class="text-danger form-text" role="alert">
                                                <small>
                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                </small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="last_name">Last Name <span>*</span></label>
                                        <input type="text" class="form-control" id="last_name" value="{{ Auth::user()->profile->last_name }}" name="last_name" required>
                                        @if ($errors->has('last_name'))
                                            <span class="text-danger form-text" role="alert">
                                                <small>
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </small>
                                            </span>
                                        @endif
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
                                        <input type="number" class="form-control" id="phone" name="phone" min="0" value="{{ Auth::user()->profile->phone }}" placeholder="Telephone" reqiured>
                                        @if ($errors->has('phone'))
                                            <span class="text-danger form-text" role="alert">
                                                <small>
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </small>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <h5 class="mb-4">Billing Address</h5>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="address">Address <span>*</span></label>
                                <input type="text" class="form-control mb-3" id="address1" name="address1" value="{{ $bill->address1 }}" placeholder="Street Address, P.O. box" required>
                                @if ($errors->has('address1'))
                                    <div class="mb-3">
                                        <span class="text-danger form-text" role="alert">
                                            <small>
                                                <strong>{{ $errors->first('address1') }}</strong>
                                            </small>
                                        </span>
                                    </div>
                                @endif
                                <input type="text" class="form-control" id="address2" name="address2" value="{{ $bill->address12 }}" placeholder="Apartment, suite, unit, building, floor, etc,">
                                @if ($errors->has('address2'))
                                    <div class="mb-3">
                                        <span class="text-danger form-text" role="alert">
                                            <small>
                                                <strong>{{ $errors->first('address2') }}</strong>
                                            </small>
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="postcode">Postcode <span>*</span></label>
                                        <input type="text" class="form-control" id="postcode" name="postcode" value="{{ $bill->postcode }}" required>
                                        @if ($errors->has('postcode'))
                                            <span class="text-danger form-text" role="alert">
                                                <small>
                                                    <strong>{{ $errors->first('postcode') }}</strong>
                                                </small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="city">Town/City <span>*</span></label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{ $bill->town_city }}" required>
                                        @if ($errors->has('city'))
                                            <span class="text-danger form-text" role="alert">
                                                <small>
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </small>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="state">Province <span>*</span></label>
                                        <input type="text" class="form-control" id="state" name="state" value="{{ $bill->province_state }}" required>
                                        @if ($errors->has('state'))
                                            <span class="text-danger form-text" role="alert">
                                                <small>
                                                    <strong>{{ $errors->first('state') }}</strong>
                                                </small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="country">Country <span>*</span></label>
                                        <select class="w-100" id="country" name="country" required>
                                            <option selected value="{{ $bill->country }}">{{ $bill->country }}</option>
                                            <option value="United States">United States</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="Germany">Germany</option>
                                            <option value="France">France</option>
                                            <option value="India">India</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Canada">Canada</option>
                                        </select>
                                        @if ($errors->has('country'))
                                            <span class="text-danger form-text" role="alert">
                                                <small>
                                                    <strong>{{ $errors->first('country') }}</strong>
                                                </small>
                                            </span>
                                        @endif
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
                                <li>
                                    <span>
                                        {{ $item->name }} x {{ $item->quantity }}<br>
                                        <small class="text-muted">
                                            @forelse ($item->attributes as $attribute)
                                                {{ $attribute }}<br />
                                            @empty
                                                {{--  --}}
                                            @endforelse
                                        </small>
                                    </span>
                                    <span>{{ presentPrice($item->price) }}</span>
                                </li>
                            @empty
                                <li><span>No items in cart</span></li>
                            @endforelse
                            @if (session()->has('coupon'))
                                <li><span>
                                    <a href="{!! route('coupon.remove') !!}">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    Discount ({{ session()->get('coupon')['name'] }}) :</span> <span>- {{ presentPrice(getNumbers()['discount']) }}</span></li>
                                <li><span>Subtotal</span> <span>{{ presentPrice(getNumbers()['newSubtotal']) }}</span></li>
                            @else
                                <li><span>Subtotal</span> <span>{{ presentPrice(Cart::getSubTotal()) }}</span></li>
                            @endif
                            <li><span>Shipping</span> <span>Free</span></li>
                            {{-- <li><span>Tax (21%)</span> <span>+ ${{ getNumbers()['newSubtotal'] + getNumbers()['tax'] }}</span></li> --}}
                            <li><span>Total </span>
                                @if (session()->has('coupon'))
                                    <span class="h5 pt-2">
                                        <strong>{{ presentPrice(getNumbers()['newTotal']) }}</strong>
                                    </span>
                                @else
                                    {{ presentPrice(Cart::getTotal()) }}
                                @endif
                            </li>
                        </ul>

                        <div class="mb-4 mt-5">
                            <h5 class="mb-4">Pay with stripe</h5>
                            <p class="text-muted">
                                Pay with your credit card via Stripe.
                            </p>
                            <div class="mt-3">
                                <div class="form-group">
                                    <label for="name_on_card">Name on Card</label>
                                    <input type="text" name="name_on_card" id="name_on_card" class="form-control" placeholder="Name on Card" value="Thavarshan" required>
                                    @if ($errors->has('name_on_card'))
                                        <span class="text-danger form-text" role="alert">
                                            <small>
                                                <strong>{{ $errors->first('name_on_card') }}</strong>
                                            </small>
                                        </span>
                                    @endif
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

                        <button id="checkout-btn" type="submit" class="btn btn-primary btn-block">Place Order</button>
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

        // Disable submit button to prevent repeated clicks
        document,getElementById('checkout-btn').disabled = true;

        var options = {
            name: document.getElementById('name_on_card').value,
            address_line1: document.getElementById('address1').value,
            address_line2: document.getElementById('address2').value,
            address_city: document.getElementById('city').value,
            address_state: document.getElementById('state').value,
            address_zip: document.getElementById('postcode').value,
            address_country: document.getElementById('country').value,
        }
        stripe.createToken(card, options).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;

                // Enable submit button if error
                document,getElementById('checkout-btn').disabled = false;

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
