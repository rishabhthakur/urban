<nav id="sidebar" class="navbar-light">
    <div class="sidebar-header text-center py-5">
        <a class="navbar-brand text-white m-0" href="{!! route('admin') !!}">
            <img src="{!! asset('img/logo-white.png') !!}" style="height: 20px">
        </a>
    </div>

    <ul class="list-unstyled components">
        {{-- <p>Dummy Heading</p> --}}
        @include('layouts.admin.includes.sidebarnav')
    </ul>
</nav>
