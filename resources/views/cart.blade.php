@extends('layouts.public.app')

@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center my-5">
                        <h2>Shopping Cart</h2>
                        <p class="text-muted">You have {{ Cart::getTotalQuantity() }} items in your shopping cart</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Checkout Area Start ##### -->
    <div class="checkout_area section-padding-80">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-7 col-lg-8">
                    <div class="checkout_details_area clearfix pr-5 mb-100">
                        <div class="table-responsive mb-5">
                            @if (count(Cart::getContent()) != 0)
                                <table class="table table-borderless mb-5">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product</th>
                                            <th scope="col"></th>
                                            <th scope="col">Price</th>
                                            <th scope="col" class="text-center">Quantity</th>
                                            <th scope="col" class="text-right">Total</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::getContent() as $item)
                                            <tr>
                                                <td width="15%">
                                                    <a href="{!! route('product', ['slug' => getProduct($item->p_id)->slug]) !!}">
                                                        <img src="{!! asset(getProduct($item->p_id)->medias->first()->url) !!}" width="100%" />
                                                    </a>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="cart-title text-left">
                                                        <div>
                                                            <span class="badge text-muted px-0">{{ __(getProduct($item->p_id)->brand->name) }}</span>
                                                        </div>
                                                        <a href="{!! route('product', ['slug' => getProduct($item->p_id)->slug]) !!}" class="text-dark h6">
                                                            <div>
                                                                <strong>{{ $item->name }}</strong>
                                                            </div>
                                                        </a>
                                                        <br>
                                                        @foreach ($item->attributes as $attrb)
                                                            <span class="text-muted">
                                                                <small>{{ $attrb }}</small>
                                                            </span><br />
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    {{ presentPrice($item->price) }}
                                                </td>
                                                <td class="align-middle" width="4%">
                                                    <input class="form-control quantity" type="number" name="quantity" min="1" value="{{ $item->quantity }}" max="{{ __(getProduct($item->p_id)->quantity) }}" data-route="{!! route('cart.update', ['id' => $item->id]) !!}"/>
                                                </td>
                                                <td class="align-middle text-right">
                                                    <strong>{{ presentPrice($item->price * $item->quantity) }}</strong>
                                                </td>
                                                <td class="align-middle text-right">
                                                    <a href="{!! route('cart.remove', ['id' => $item->id]) !!}">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h4>Your shopping cart is empty</h4>
                                <p>
                                    Make sure to <a href="{!! route('register') !!}">sign up</a> for a new account or <a href="{!! route('login') !!}">sign in</a> to your account<br />
                                    before you proceed to the checkout page.
                                </p>
                            @endif
                        </div>
                        @if (!Cart::isEmpty())
                            <div class="row">
                                <div class="col-lg-6">
                                    <form id="coupon-form" action="{!! route('coupon.add') !!}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="coupon">Have a Coupon Code?</label>
                                            <div class="coupon_input_container">
                                                <input type="text" name="coupon" id="coupon" class="form-control border-0" placeholder="Apply Coupon">
                                                @if ($errors->has('coupon'))
                                                    <span class="text-danger form-text" role="alert">
                                                        <small>
                                                            <strong>{{ $errors->first('coupon') }}</strong>
                                                        </small>
                                                    </span>
                                                @endif
                                                <button type="submit" class="submit_btn">
                                                    <i aria-hidden="true" class="fa fa-long-arrow-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                        <div class="mt-5 d-flex justify-content-between flex-column flex-lg-row">
                            <a href="{!! route('shop') !!}" class="btn btn-link text-muted px-0 mb-3">
                                <i class="fa fa-chevron-left"></i> Continue Shopping
                            </a>
                            @if (count(Cart::getContent()) != 0)
                                <a href="{!! route('checkout') !!}" class="btn btn-dark mb-3">
                                    Proceed to checkout <i class="fa fa-chevron-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-5 col-lg-4">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Cart Totals</h5>
                            <p>Shipping and additional costs are calculated based on values you have entered.</p>
                        </div>

                        <ul class="order-details-form mb-0">
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
                            {{-- <li><span>Tax (21%)</span> <span>+ {{ presentPrice(getNumbers()['newSubtotal'] + getNumbers()['tax']) }}</span></li> --}}
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

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Checkout Area End ##### -->
@endsection


@section('cart-js')
    <script type="text/javascript">
        (function() {
            const classname = document.querySelectorAll('.quantity');
            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function(element) {
                    const route = this.getAttribute('data-route');
                    console.log(route);
                    axios.post(route, {
                        quantity: this.value
                    })
                    .then(function (response) {
                        console.log(response);
                        window.location.href = '{{ route('cart') }}';
                    })
                    .catch(function (error) {
                        console.log(error);
                        window.location.href = '{{ route('cart') }}';
                    });
                });
            });
        }());
    </script>
@endsection
