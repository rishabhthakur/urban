
<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="{!! route('home') !!}">
                <img src="{!! asset('img/logo-black.png') !!}" alt="" height="30px">
            </a>
            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
                <span class="navbarToggler">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </div>
            <!-- Menu -->
            <div class="classy-menu">
                <!-- close btn -->
                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <!-- Nav Start -->
                <div class="classynav">
                    <ul>
                        <li><a href="{!! route('home') !!}">Home</a></li>
                        <li><a href="blog.html">Shop</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="blog.html">About</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>
                <!-- Nav End -->
            </div>
        </nav>

        <!-- Header Meta Data -->
        <div class="header-meta d-flex clearfix justify-content-end">
            <!-- Search Area -->
            <div class="search-area">
                <form action="#" method="post">
                    <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            @auth
                <!-- Favourite Area -->
                <div class="favourite-area">
                    <a href="#"><img src="{!! asset('img/core-img/heart.svg') !!}" alt=""></a>
                </div>
            @endauth
            <!-- User Login Info -->
            <div class="user-login-info">
                <a href="{!! route('account') !!}"><img src="{!! asset('img/core-img/user.svg') !!}" alt=""></a>
            </div>
            <!-- Cart Area -->
            <div class="cart-area">
                <a href="#" id="essenceCartBtn">
                    <img src="{!! asset('img/core-img/bag.svg') !!}" alt=""> <span>{{ Cart::count() }}</span>
                </a>
            </div>
        </div>

    </div>
</header>
