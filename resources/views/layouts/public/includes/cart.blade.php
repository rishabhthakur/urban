<div class="cart-bg-overlay"></div>

<div class="right-side-cart-area">

    <!-- Cart Button -->
    <div class="cart-button">
        <a href="#" id="rightSideCart"><img src="img/core-img/bag.svg" alt=""> <span>{{ count(Cart::getContent()) }}</span></a>
    </div>

    <div class="cart-content d-flex">

        @if (count(Cart::getContent()) > 0)
            <!-- Cart List Area -->
            <div class="cart-list">
                <!-- Single Cart Item -->
                <div class="single-cart-item">
                    <a href="#" class="product-image">
                        <img src="img/product-img/product-1.jpg" class="cart-thumb" alt="">
                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                          <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                            <span class="badge">Mango</span>
                            <h6>Button Through Strap Mini Dress</h6>
                            <p class="size">Size: S</p>
                            <p class="color">Color: Red</p>
                            <p class="price">$45.00</p>
                        </div>
                    </a>
                </div>
            </div>
        @endif

        <!-- Cart Summary -->
        <div class="cart-amount-summary">

            @if (count(Cart::getContent()) > 0)
                <h2>Summary</h2>
                <ul class="summary-table">
                    <li><span>subtotal:</span> <span>${{ Cart::getSubTotal() }}</span></li>
                    <li><span>delivery:</span> <span>Free</span></li>
                    <li><span>disgetContent:</span> <span>-15%</span></li>
                    <li><span>total:</span> <span>${{ Cart::getTotal() }}</span></li>
                </ul>
                <div class="checkout-btn mt-100">
                    <a href="checkout.html" class="btn btn-primary btn-block mb-1">Check Out</a>
                    <a href="{!! route('cart') !!}" class="btn btn-outline-primary btn-block">View Cart</a>
                </div>
            @else
                <h2>No products in the cart</h2>
                <div class="checkout-btn mt-100">
                    <a href="checkout.html" class="btn btn-dark btn-block">Start Shopping</a>
                </div>
            @endif
        </div>
    </div>
</div>
