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
                        <div class="table-responsive">
                            @if (count(Cart::getContent()) != 0)
                                <table class="table table-borderless">
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
                                                    ${{ $item->price }}
                                                </td>
                                                <td class="align-middle" width="4%">
                                                    <input class="form-control" type="number" min="0" value="{{ $item->quantity }}" max="{{ __(getProduct($item->p_id)->quantity) }}" />
                                                </td>
                                                <td class="align-middle text-right">
                                                    <strong>${{ $item->price * $item->quantity }}</strong>
                                                </td>
                                                <td class="align-middle text-right">
                                                    <a href="{!! route('cart.remove', ['id' => $item->id]) !!}">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                    <br>
                                                    <a href="{!! route('cart.save', ['id' => $item->id]) !!}">
                                                        <i class="fa fa-save"></i>
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
                        <div class="mt-5 d-flex justify-content-between flex-column flex-lg-row">
                            <a href="{!! route('shop') !!}" class="btn btn-link text-muted px-0">
                                <i class="fa fa-chevron-left"></i> Continue Shopping
                            </a>
                            @if (count(Cart::getContent()) != 0)
                                <a href="{!! route('checkout') !!}" class="btn btn-dark">
                                    Proceed to checkout <i class="fa fa-chevron-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="checkout_details_area clearfix pr-5 mt-100">
                        <div class="d-flex justify-content-between flex-column flex-lg-row">
                            <div class="table-responsive">
                                @if (count(app('saveForLater')->getContent()) != 0)
                                    <h4>Items saved for later</h4>
                                    <p class="text-muted mb-5">You have {{ app('saveForLater')->getTotalQuantity() }} items in your saved for later list</p>
                                    <table class="table table-borderless">
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
                                            @foreach (app('saveForLater')->getContent() as $item)
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
                                                        ${{ $item->price }}
                                                    </td>
                                                    <td class="align-middle" width="4%">
                                                        <input class="form-control" type="number" min="0" value="{{ $item->quantity }}" max="{{ __(getProduct($item->p_id)->quantity) }}" />
                                                    </td>
                                                    <td class="align-middle text-right">
                                                        <strong>${{ $item->price * $item->quantity }}</strong>
                                                    </td>
                                                    <td class="align-middle text-right">
                                                        <a href="{!! route('cart.save.remove', ['id' => $item->id]) !!}">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                        <br>
                                                        <a href="{!! route('cart.save.restore', ['id' => $item->id]) !!}">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    {{--  --}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-5 col-lg-4">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Your Order</h5>
                            <p>Shipping and additional costs are calculated based on values you have entered.</p>
                        </div>

                        <ul class="order-details-form mb-0">
                            <li><span>Subtotal</span> <span>${{ Cart::getSubTotal() }}</span></li>
                            <li><span>Shipping</span> <span>Free</span></li>
                            <li><span>Total</span> <span class="h5">${{ Cart::getTotal() }}</span></li>
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
                    const item = this.getAttribute('data-route')
                    // console.log(item);
                    axios.post(item, {
                        quantity: this.value
                    })
                    .then(function (response) {
                        console.log(response);
                        window.location.href = '{{ route('cart') }}';
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                });
            });
        }());
    </script>
@endsection
