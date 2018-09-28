<ul class="nav nav-pills nav-fill flex-column flex-sm-row">
    <li class="nav-item">
        <a class="nav-link mb-sm-3 mb-md-0 @if (Route::currentRouteName() == 'admin.settings') active @endif" href="{!! route('admin.settings') !!}">
            <i class="fas fa-cog mr-1"></i>
            General
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link mb-sm-3 mb-md-0" href="#">
            <i class="fas fa-shopping-basket mr-1"></i>
            Shop
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link mb-sm-3 mb-md-0 @if (Route::currentRouteName() == 'admin.settings.discussion') active @endif" href="{!! route('admin.settings.discussion') !!}">
            <i class="fas fa-comments mr-1"></i>
            Discussion
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link mb-sm-3 mb-md-0" href="#">
            <i class="fas fa-image mr-1"></i>
            Media
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link mb-sm-3 mb-md-0 @if (Route::currentRouteName() == 'admin.settings.privacy') active @endif" href="{!! route('admin.settings.privacy') !!}#">
            <i class="fas fa-unlock-alt mr-1"></i>
            Privacy
        </a>
    </li>
</ul>
