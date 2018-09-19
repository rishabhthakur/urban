<nav class="navbar navbar-expand-lg navbar-light bg-transparent p-0">
    <button type="button" id="sidebarCollapse" class="btn btn-link">
        <i class="fas fa-bars"></i>
    </button>
    <button class="btn btn-primary d-inline-block d-lg-none ml-auto shadow-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-lg-0">
            <input class="form-control mr-auto bg-transparent border-0" type="search" style="width: 350px;" placeholder="Type and hit enter to search..." aria-label="search">
        </form>
        <ul class="nav navbar-nav ml-auto align-items-lg-center">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="view" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-eye fa-lg"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="view">
                    <a class="dropdown-item" href="#">Visit Public</a>
                    <a class="dropdown-item" href="#">Visit Blog</a>
                    <a class="dropdown-item" href="#">Visit Shop</a>
                </div>
            </li>
            <notifications></notifications>
            <li class="nav-item dropdown d-lg-block">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{!! Auth::user()->profile->avatar !!}" alt="..." class="rounded-circle" width="32px" height="32px">
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-item-text">
                        <div>
                            <small>Signed in as,</small>
                            <h6>{{ Auth::user()->name }}</h6>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Activities</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Help &amp; Support</a>
                    <a class="dropdown-item" href="#">Settings &amp; Privacy</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Log Out') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
