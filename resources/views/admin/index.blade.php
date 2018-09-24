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
                                    <h1>190</h1>
                                    <a href="#">
                                        Products
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <span class="badge badge-danger">
                                            <i class="fas fa-exclamation-circle mr-1"></i> <strong>50</strong> Out of stock
                                        </span>
                                        <span class="badge badge-warning">
                                            <i class="fas fa-exclamation-circle mr-1"></i> <strong>50</strong> Low in stock
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col">
                                    <h1>89</h1>
                                    <a href="#">
                                        Customers
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <span class="badge badge-warning">
                                            <i class="fas fa-exclamation-circle mr-1"></i> <strong>5</strong> Unverified
                                        </span>
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
                                        <i class="fas fa-circle text-success mr-1"></i> Website active
                                    </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-item-text">
                                        <p class="text-muted mb-0">
                                            <small>
                                                We recomend that you keep the website status live unless drastic changes, database upgrades and major upgrades have been scheduled. In that case you should head over to the <a href="{!! route('admin.settings') !!}">settings page</a> and switch the <strong>site status</strong> option to off. This will activate <code>code 503 - site under maintenance</code> or <strong>maintenance mode</strong>.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <label>Website privacy policy</label>
                            <div class="mb-3">
                                <span class="badge">
                                    <i class="fas fa-circle text-success mr-1"></i> Page set
                                </span>
                            </div>
                            <label>Website legal information</label>
                            <div class="mb-3">
                                <span class="badge">
                                    <i class="fas fa-circle text-success mr-1"></i> Page set
                                </span>
                            </div>
                            <label>Site membership</label>
                            <div class="mb-3">
                                <span class="badge">
                                    <i class="fas fa-circle text-success mr-1"></i> Anyone can register
                                </span>
                            </div>
                            <div class="text-center">
                                <small>
                                    <a href="{!! route('admin.settings') !!}">
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
                            <li>
                                @switch($activity->model)
                                    @case('Product\Product')
                                        <strong class="text-primary">New product added.</strong>
                                        @break
                                    @case('Product\Category')
                                        <strong class="text-primary">New product category added.</strong>
                                        @break
                                    @case('Product\Tag')
                                        <strong class="text-primary">New product tag added.</strong>
                                        @break
                                    @case('Product\Attribute')
                                        <strong class="text-primary">New product attribute added.</strong>
                                        @break
                                    @case('Product\Brand')
                                        <strong class="text-primary">New product brand added.</strong>
                                        @break
                                    @case('Media\Media')
                                        <strong class="text-primary">New media item added.</strong>
                                        @break
                                    @case('User\Login')
                                        <strong class="text-primary">User loggin.</strong>
                                        @break
                                @endswitch
            					<span class="float-right badge badge-primary">{{ $activity->created_at->format("F j, Y") }}</span>
            					<p>
                                    <a href="#"><strong>{{ $activity->user->name }}</strong></a> {{ $activity->task }}
                                </p>
            				</li>
                        @empty
                            <li>
                                No recent activity
                            </li>
                        @endforelse
        			</ul>
                </div>
            </div>
        </div>
    </div>
@endsection
