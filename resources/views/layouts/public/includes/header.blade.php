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
            <div id="mobileMenu" class="classy-menu">
                <!-- close btn -->
                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <!-- Nav Start -->
                <div class="classynav">
                    <ul>
                        <li><a href="{!! route('home') !!}">Home</a></li>
                        <li><a href="{!! route('shop') !!}">Shop</a></li>
                        <li><a href="{!! route('blog') !!}">Blog</a></li>
                        <li><a href="{!! route('about') !!}">About</a></li>
                        <li><a href="{!! route('contact') !!}">Contact</a></li>
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
                    <button type="submit">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
            @auth
                <!-- Favourite Area -->
                <div class="favourite-area">
                    <a href="#">
                        <i class="fas fa-heart"></i>
                    </a>
                </div>
            @endauth
            @guest
                <!-- User Login Info -->
                <div class="user-login-info">
                    <a href="{!! route('account') !!}">
                        <i class="fas fa-user"></i>
                    </a>
                </div>
            @else
                <!-- User Login Info -->
                <div class="user-login-info">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-power-off"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @endguest
            <!-- Cart Area -->
            <div class="cart-area">
                <a href="#" id="essenceCartBtn">
                    <i class="fas fa-shopping-bag"></i> <span>{{ count(Cart::getContent()) }}</span>
                </a>
            </div>
        </div>

    </div>
</header>
