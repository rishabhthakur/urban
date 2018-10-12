<div class="cart-bg-overlay"></div>

<div class="right-side-cart-area">

    <!-- Cart Button -->
    <div class="cart-button">
        <a href="#" id="rightSideCart"><i class="fas fa-times"></i></a>
    </div>

    <div class="cart-content d-flex">

        @if (!Cart::isEmpty())
            <!-- Cart List Area -->
            <div class="cart-list">
                @foreach (Cart::getContent() as $item)
                    <!-- Single Cart Item -->
                    <div class="single-cart-item">
                        <span class="product-image">
                            <img src="{!! asset(getProduct($item->p_id)->medias->first()->url) !!}" class="cart-thumb" alt="" width="100%">
                            <!-- Cart Item Desc -->
                            <div class="cart-item-desc">
                                <a href="{!! route('cart.remove', ['id' => $item->id]) !!}" class="product-remove">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </a>
                                <span class="badge">{{ __(getProduct($item->p_id)->brand->name) }}</span>
                                <h6>{{ $item->name }}</h6>
                                @foreach ($item->attributes as $attrb)
                                    <p class="color">{{ $attrb }}</p>
                                @endforeach
                                <p class="color">{{ presentPrice($item->price) }} <span class="ml-1">x {{ $item->quantity }}</span></p>

                                <p class="price">
                                    {{ presentPrice($item->price) }}
                                </p>
                            </div>
                        </span>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Cart Summary -->
        <div class="cart-amount-summary">

            @if (count(Cart::getContent()) > 0)
                <h2>Summary</h2>
                <ul class="summary-table">
                    <li><span>subtotal:</span> <span>
                        @if (session()->has('coupon'))
                            {{ presentPrice(getNumbers()['newSubtotal']) }}
                        @else
                            {{ presentPrice(Cart::getSubTotal()) }}
                        @endif</span></li>
                    <li><span>shipping:</span> <span>Free</span></li>
                    @if (session()->has('coupon'))
                        <li><span>discount:</span> <span>- {{ presentPrice(getNumbers()['discount']) }}</span></li>
                    @endif
                    <li><span>total:</span> <span>
                    @if (session()->has('coupon'))
                        {{ presentPrice(getNumbers()['newTotal']) }}
                    @else
                        {{ presentPrice(Cart::getTotal()) }}
                    @endif</span></li>
                </ul>
                <div class="checkout-btn mt-100">
                    <a href="{!! route('checkout') !!}" class="btn btn-primary btn-block mb-1">Check Out</a>
                    <a href="{!! route('cart') !!}" class="btn btn-outline-primary btn-block">View Cart</a>
                </div>
            @else
                <h2 class="mb-3">
                    No products<br>
                    in your shopping cart
                </h2>
                <p>
                    Make sure to sign up for a new account or sign in to your account
                    before you proceed to the checkout page.
                </p>
                <div class="checkout-btn mt-100">
                    <a href="{!! route('shop') !!}" class="btn btn-dark btn-block">Start Shopping</a>
                </div>
            @endif
        </div>
    </div>
</div>
