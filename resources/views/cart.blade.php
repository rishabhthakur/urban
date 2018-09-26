@extends('layouts.public.app')

@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center my-5">
                        <h2>Shopping Cart</h2>
                        <p class="text-muted">You have 3 items in your shopping cart</p>
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
                    <div class="checkout_details_area clearfix">
                        <div class="table-responsive">
                            @if (count(Cart::getContent()) != 0)
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col"> </th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col" class="text-center">Quantity</th>
                                            <th scope="col" class="text-right">Total</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="15%">
                                                <img src="https://d19m59y37dris4.cloudfront.net/sell/1-2-1/img/product/product-square-ian-dooley-347968-unsplash.jpg" width="100%" />
                                            </td>
                                            <td class="align-middle">
                                                <div class="cart-title text-left">
                                                    <a href="detail.html" class="text-dark h6">
                                                        <strong>Skull Tee</strong>
                                                    </a>
                                                    <br>
                                                    <span class="text-muted">
                                                        <small>Size: Large</small>
                                                    </span>
                                                    <br>
                                                    <span class="text-muted">
                                                        <small>Colour: Green</small>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                $124,90
                                            </td>
                                            <td class="align-middle" width="4%">
                                                <input class="form-control" type="number" min="0" value="1" />
                                            </td>
                                            <td class="align-middle text-right">
                                                <strong>$124,90</strong>
                                            </td>
                                            <td class="align-middle text-right">
                                                <a href="#">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <h4>Your cart is empty</h4>
                                <p>
                                    Make sure to sign up for a new account or sign in to your account<br />
                                    before you proceed to the checkout page.
                                </p>
                            @endif
                        </div>
                        <div class="my-5 d-flex justify-content-between flex-column flex-lg-row">
                            <a href="{!! route('home') !!}" class="btn btn-link text-muted">
                                <i class="fa fa-chevron-left"></i> Continue Shopping
                            </a>
                            @if (count(Cart::getContent()) != 0)
                                <a href="{!! route('checkout') !!}" class="btn btn-dark">
                                    Proceed to checkout <i class="fa fa-chevron-right"></i>
                                </a>
                            @endif
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
