@extends('layouts.admin.app')

@section('content')
    <div class="row">
        <div class="col-lg-7">
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
                        <div class="col-md-6 mb-3">
                            <h6>Next step</h6>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link disabled" href="{{ route('admin.settings') }}">
                                        <i class="fas fa-edit"></i>
                                        Edit front page
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.posts.create') }}">
                                        <i class="fas fa-edit"></i>
                                        Add blog post
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}">
                                        <i class="fas fa-eye"></i>
                                        Visit your site
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>More Actions</h6>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.settings.discussion') }}">
                                        <i class="far fa-comment-alt"></i>
                                        Turn comments on or off
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.settings') }}">
                                        <i class="fas fa-cog"></i>
                                        Site settings
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" href="#">
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
        <div class="col-lg-5">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="#">
                                        Orders
                                    </a>
                                    <h1 class="mb-0">{{ count($orders->get()) }}</h1>
                                    <div>
                                        <small>
                                            {{ count($orders->where('shipped', 0)->get()) }} Orders pending
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="#">
                                        Customers
                                    </a>
                                    <h1 class="mb-0">
                                        {{ count($users->where('role_id', 4)->get()) }}
                                    </h1>
                                    <div class="text-warning">
                                        @if (count($users->where('email_verified_at', null)->get()) > 0)
                                            <small>
                                                {{ count($users->where('role_id', 4)->where('email_verified_at', null)->get()) }} Unverified
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
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
                            </div>
                            <div>
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
                            </div>
                            <div>
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
                            </div>
                            <div>
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
        <div class="col-lg-5 offset-lg-7">
            <div class="card">
                <div class="card-body pb-0">
                    <h6 class="heading mb-3">Recent Activities</h6>
                </div>
                <div id="timeline-card" class="card-body pt-0">
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


@section('admin-js')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#timeline-card").mCustomScrollbar({
                theme: "minimal-dark"
            });
        });
    </script>
@endsection
