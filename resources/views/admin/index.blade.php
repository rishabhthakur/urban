@extends('layouts.admin.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">
                        Welcome to your<br />
                        Dashboard, {{ Auth::user()->name }}!
                    </h5>
                    <p>
                        We’ve assembled some links to get you started:
                    </p>
                    <p>
                        <a href="#" class="btn btn-primary">Customize Your Site</a>
                    </p>
                    <div class="row mt-5">
                        <div class="col">
                            <h6>Next step</h6>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fas fa-edit"></i>
                                        Edit front page
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fas fa-edit"></i>
                                        Add blog post
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fas fa-eye"></i>
                                        Visit your site
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col">
                            <h6>More Actions</h6>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="far fa-comment-alt"></i>
                                        Turn comments on or off
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fas fa-cog"></i>
                                        Site settings
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fas fa-graduation-cap"></i>
                                        Learn more
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <ul class="list-group list-group-flush bg-transparent">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">
                                    <h1>120</h1>
                                    <a href="#">
                                        Orders
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <span class="badge badge-warning">
                                            <i class="fas fa-exclamation-circle mr-1"></i> Pending
                                        </span>
                                        <span class="badge badge-danger">
                                            <i class="fas fa-times-circle mr-1"></i> Cancelled
                                        </span>
                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle mr-1"></i> Completed
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">
                                    <h1>
                                        @if ($products->all())
                                            {{ count($products->all()) }}
                                        @endif
                                    </h1>
                                    <a href="{!! route('admin.products') !!}">
                                        Products
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        @if ($products->getOutOfStock() && count($products->getOutOfStock()) > 0)
                                            <span class="badge badge-danger">
                                                <i class="fas fa-exclamation-circle mr-1"></i> <strong>{{ count($products->getOutOfStock()) }}</strong> Out of stock
                                            </span>
                                        @endif
                                        @if ($products->getLowStock() && count($products->getLowStock()) > 0)
                                            <span class="badge badge-warning">
                                                <i class="fas fa-exclamation-circle mr-1"></i> <strong>{{ count($products->getLowStock()) }}</strong> Low in stock
                                            </span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">
                                    <h1>{{ count($users->where('role_id', 4)->get()) }}</h1>
                                    <a href="#">
                                        Customers
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        @if (count($users->where('role_id', 4)->where('email_verified_at', null)->get()) > 0)
                                            <span class="badge badge-warning">
                                                <i class="fas fa-exclamation-circle mr-1"></i> <strong>{{ count($users->where('role_id', 4)->where('email_verified_at', null)->get()) }}</strong> Unverified
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <label>Site status</label>
                            </div>
                            <div class="dropdown mb-3">
                                <a class="text-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="badge">
                                        @if ($settings->first()->status == 1)
                                            <i class="fas fa-circle text-success mr-1"></i> Website active
                                        @else
                                            <i class="fas fa-circle text-warning mr-1"></i> Website in maintenance mode
                                        @endif
                                    </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-item-text">
                                        <p class="text-muted mb-0">
                                            <small>
                                                @if ($settings->first()->status)
                                                    We recomend that you keep the website status live unless drastic changes, database upgrades and major upgrades have been scheduled. In that case you should head over to the <a href="{!! route('admin.settings') !!}">settings page</a> and switch the <strong>site status</strong> option to off. This will activate <code>code 503 - site under maintenance</code> or <strong>maintenance mode</strong>.
                                                @else
                                                    The sooner the site is back the better.
                                                @endif
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <label>Website privacy policy</label>
                            <div class="mb-3">
                                <span class="badge">
                                    @if ($settings->first()->privacy)
                                        <i class="fas fa-circle text-success mr-1"></i> Page set
                                    @else
                                        <i class="fas fa-circle text-danger mr-1"></i> Page not set
                                    @endif
                                </span>
                            </div>
                            <label>Website legal information</label>
                            <div class="mb-3">
                                <span class="badge">
                                    @if ($settings->first()->legal)
                                        <i class="fas fa-circle text-success mr-1"></i> Page set
                                    @else
                                        <i class="fas fa-circle text-danger mr-1"></i> Page not set
                                    @endif
                                </span>
                            </div>
                            <label>Site membership</label>
                            <div class="mb-3">
                                <span class="badge">
                                    @if ($settings->first()->membership)
                                        <i class="fas fa-circle text-success mr-1"></i> Anyone can register
                                    @else
                                        <i class="fas fa-circle text-warning mr-1"></i> No one can register
                                    @endif
                                </span>
                            </div>
                            <div class="mt-5">
                                <small>
                                    <a href="{!! route('admin.settings') !!}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-cog"></i>
                                        Settings
                                    </a>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <h4>Recent Activity</h4>
        			<ul class="timeline">
        				@forelse ($activities as $activity)
                            @include('admin.includes.activity')
                        @empty
                            No recent activity
                        @endforelse
        			</ul>
                </div>
            </div>
        </div>
    </div>
@endsection
