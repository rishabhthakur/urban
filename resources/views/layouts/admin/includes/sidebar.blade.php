<nav id="sidebar" class="navbar-light bg-black active">
    <div class="sidebar-header text-center py-5">
        <a class="navbar-brand text-white m-0" href="#">
            <img src="{!! asset('img/logo-white.png') !!}" style="height: 20px">
        </a>
    </div>

    <ul class="list-unstyled components">
        {{-- <p>Dummy Heading</p> --}}
        <li>
            <a href="{!! route('admin') !!}">
                <i class="fas fa-tachometer-alt mr-2"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="#media" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-image mr-2"></i>
                Media
            </a>
            <ul class="collapse list-unstyled" id="media">
                <li>
                    <a href="{!! route('admin.media') !!}">Library</a>
                </li>
                <li>
                    <a href="{!! route('admin.media.create') !!}">Add New</a>
                </li>
            </ul>
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
        <li>
            <a href="#products" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-box mr-2"></i>
                Products
            </a>
            <ul class="collapse list-unstyled" id="products">
                <li>
                    <a href="#">All Products</a>
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
                    <a href="#">Brands</a>
                </li>
                <li>
                    <a href="#">Attributes</a>
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
        <li>
            <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-users mr-2"></i>
                Users
            </a>
            <ul class="collapse list-unstyled" id="users">
                <li>
                    <a href="#">All Users</a>
                </li>
                <li>
                    <a href="#">Add New</a>
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
                    <a href="#">Theme</a>
                </li>
                <li>
                    <a href="#">Pages</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#settings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-cog mr-2"></i>
                Settings
            </a>
            <ul class="collapse list-unstyled" id="settings">
                <li>
                    <a href="{!! route('admin.settings') !!}">General</a>
                </li>
                <li>
                    <a href="{!! route('admin.settings.shop') !!}">Shop</a>
                </li>
                <li>
                    <a href="{!! route('admin.settings.discussions') !!}">Discussion</a>
                </li>
                <li>
                    <a href="{!! route('admin.settings.media') !!}">Media</a>
                </li>
                <li>
                    <a href="{!! route('admin.settings.privacy') !!}">Privacy</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
