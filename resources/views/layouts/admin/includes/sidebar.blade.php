<nav id="sidebar" class="navbar-light">
    <div class="sidebar-header text-center py-5">
        <a class="navbar-brand text-white m-0" href="{!! route('admin') !!}">
            <img src="{!! asset('img/logo-white.png') !!}" style="height: 20px">
        </a>
    </div>

    <ul class="list-unstyled components">
        {{-- <p>Dummy Heading</p> --}}
        <li @if (Route::currentRouteName() == 'admin') class="active" @endif>
            <a href="{!! route('admin') !!}">
                <i class="fas fa-tachometer-alt mr-2"></i>
                Dashboard
            </a>
        </li>
        <li
            @if (
                Route::currentRouteName() == 'admin.media' ||
                Route::currentRouteName() == 'admin.media.create'
                )
                 class="active"
            @endif
        >
            <a href="#media" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-image mr-2"></i>
                Media
            </a>
            <ul class="collapse list-unstyled" id="media">
                <li @if (Route::currentRouteName() == 'admin.media') class="active" @endif>
                    <a href="{!! route('admin.media') !!}">Library</a>
                </li>
                <li @if (Route::currentRouteName() == 'admin.media.create') class="active" @endif>
                    <a href="{!! route('admin.media.create') !!}">Add New</a>
                </li>
            </ul>
        </li>
        <li @if (Route::currentRouteName() == 'admin.messages') class="active" @endif>
            <a href="{!! route('admin.messages') !!}" class="clearfix">
                <i class="fas fa-envelope mr-2"></i>
                Messages @if (count(getUnreadMessages()) > 0)
                     <span class="badge badge-pill badge-danger bg-danger text-white float-right">{{ __(count(getUnreadMessages())) }}</span>
                @endif
            </a>
        </li>
        <li @if (Route::currentRouteName() == 'admin.newsletter') class="active" @endif>
            <a href="{!! route('admin.newsletter') !!}">
                <i class="fas fa-newspaper mr-2"></i>
                Newsletter
            </a>
        </li>
        <li>
            <a href="#sales" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-shopping-cart mr-2"></i>
                Sales
            </a>
            <ul class="collapse list-unstyled" id="sales">
                <li>
                    <a href="#">Orders</a>
                </li>
                <li>
                    <a href="#">Report</a>
                </li>
                <li>
                    <a href="#">Revenue</a>
                </li>
                <li>
                    <a href="#">Reviews</a>
                </li>
            </ul>
        </li>
        <li
            @if (
                Route::currentRouteName() == 'admin.products' ||
                Route::currentRouteName() == 'admin.products.create' ||
                Route::currentRouteName() == 'admin.products.categories' ||
                Route::currentRouteName() == 'admin.products.tags' ||
                Route::currentRouteName() == 'admin.products.brands' ||
                Route::currentRouteName() == 'admin.products.attributes'
                )
                 class="active"
            @endif
        >
            <a href="#products" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-box mr-2"></i>
                Products
            </a>
            <ul class="collapse list-unstyled" id="products">
                <li @if (Route::currentRouteName() == 'admin.products') class="active" @endif>
                    <a href="{!! route('admin.products') !!}">All Products</a>
                </li>
                <li @if (Route::currentRouteName() == 'admin.products.create') class="active" @endif>
                    <a href="{!! route('admin.products.create') !!}">Add New</a>
                </li>
                <li @if (Route::currentRouteName() == 'admin.products.categories') class="active" @endif>
                    <a href="{!! route('admin.products.categories') !!}">Categories</a>
                </li>
                <li @if (Route::currentRouteName() == 'admin.products.tags') class="active" @endif>
                    <a href="{!! route('admin.products.tags') !!}">Tags</a>
                </li>
                <li @if (Route::currentRouteName() == 'admin.products.brands') class="active" @endif>
                    <a href="{!! route('admin.products.brands') !!}">Brands</a>
                </li>
                <li @if (Route::currentRouteName() == 'admin.products.attributes') class="active" @endif>
                    <a href="{!! route('admin.products.attributes') !!}">Attributes</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#blog" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-comment-alt mr-2"></i>
                Blog
            </a>
            <ul class="collapse list-unstyled" id="blog">
                <li>
                    <a href="#">All Posts</a>
                </li>
                <li>
                    <a href="#">Add New</a>
                </li>
                <li>
                    <a href="#">Categories</a>
                </li>
                <li>
                    <a href="#">Tags</a>
                </li>
                <li>
                    <a href="#">Comments</a>
                </li>
            </ul>
        </li>
        <li
        @if (
            Route::currentRouteName() == 'admin.users' ||
            Route::currentRouteName() == 'admin.users.customers' ||
            Route::currentRouteName() == 'admin.users.staff' ||
            Route::currentRouteName() == 'admin.users.create'
            )
             class="active"
        @endif>
            <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-users mr-2"></i>
                Users
            </a>
            <ul class="collapse list-unstyled" id="users">
                <li @if (Route::currentRouteName() == 'admin.users') class="active" @endif>
                    <a href="{!! route('admin.users') !!}">All Users</a>
                </li>
                <li @if (Route::currentRouteName() == 'admin.users.customers') class="active" @endif>
                    <a href="{!! route('admin.users.customers') !!}">Customers</a>
                </li>
                <li @if (Route::currentRouteName() == 'admin.users.staff') class="active" @endif>
                    <a href="{!! route('admin.users.staff') !!}">Staff</a>
                </li>
                <li @if (Route::currentRouteName() == 'admin.users.create') class="active" @endif>
                    <a href="{!! route('admin.users.create') !!}">Add New</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#customize" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-palette mr-2"></i>
                Customize
            </a>
            <ul class="collapse list-unstyled" id="customize">
                <li>
                    <a href="#">General</a>
                </li>
                <li>
                    <a href="#">Pages</a>
                </li>
            </ul>
        </li>
        <li @if (
                Route::currentRouteName() == 'admin.settings' ||
                Route::currentRouteName() == 'admin.settings.shop' ||
                Route::currentRouteName() == 'admin.settings.discussion' ||
                Route::currentRouteName() == 'admin.settings.media' ||
                Route::currentRouteName() == 'admin.settings.privacy'
                )
                class="active"
            @endif>
            <a href="#settings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-cog mr-2"></i>
                Settings
            </a>
            <ul class="collapse list-unstyled" id="settings">
                <li @if (Route::currentRouteName() == 'admin.settings') class="active" @endif>
                    <a href="{!! route('admin.settings') !!}">General</a>
                </li>
                <li @if (Route::currentRouteName() == 'admin.settings.shop') class="active" @endif>
                    <a href="{!! route('admin.settings.shop') !!}">Shop</a>
                </li>
                <li @if (Route::currentRouteName() == 'admin.settings.discussion') class="active" @endif>
                    <a href="{!! route('admin.settings.discussion') !!}">Discussion</a>
                </li>
                <li @if (Route::currentRouteName() == 'admin.settings.media') class="active" @endif>
                    <a href="{!! route('admin.settings.media') !!}">Media</a>
                </li>
                <li @if (Route::currentRouteName() == 'admin.settings.privacy') class="active" @endif>
                    <a href="{!! route('admin.settings.privacy') !!}">Privacy</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
