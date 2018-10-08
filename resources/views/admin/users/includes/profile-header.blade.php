<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body profile-user-box">

                <div class="row">
                    <div class="col-sm-8">
                        <div class="media">
                            <span class="float-left m-2 mr-4 text-center">
                                <img src="{{ $user->profile->avatar }}" style="height: 130px;" alt="" class="rounded-circle img-thumbnail">
                            </span>
                            <div class="media-body">

                                <h5 class="mb-0 text-primary">
                                    {{ $user->profile->first_name . ' ' . $user->profile->last_name}}
                                </h5>
                                @if (Auth::user()->role_id < 3)
                                    @if (!$user->email_verified_at)
                                        <p>
                                            <span class="badge text-warning">Account unverified</span>
                                            <a href="{!! route('admin.users.verify', ['id' => $user->id]) !!}" class="badge badge-secondary">Verify accouny</a>
                                        </p>
                                    @else
                                        <p>
                                            <span class="badge badge-primary">{{ $user->role->name }}</span><br>
                                            <span class="badge">
                                                <i class="fas fa-circle text-success mr-1"></i> Online
                                            </span>
                                        </p>
                                    @endif
                                @else
                                    <p>
                                        <span class="badge badge-primary">{{ $user->role->name }}</span><br>
                                        <span class="badge">
                                            <i class="fas fa-circle text-success mr-1"></i> Online
                                        </span>
                                    </p>
                                @endif


                                <ul class="mb-0 list-inline">
                                    @if ($user->role_id <= 3)
                                        @if ($user->role_id <= 2)
                                            <li class="list-inline-item mr-3 text-center">
                                                <h5 class="mb-1 text-success">$1840</h5>
                                                <p class="mb-0">
                                                    <small>Revenue</small>
                                                </p>
                                            </li>
                                            <li class="list-inline-item mr-3 text-center">
                                                <h5 class="mb-1">{{ count($user->products) }}</h5>
                                                <p class="mb-0">
                                                    <small>Products</small>
                                                </p>
                                            </li>
                                        @endif
                                        <li class="list-inline-item mr-3 text-center">
                                            <h5 class="mb-1">{{ count($user->posts) }}</h5>
                                            <p class="mb-0">
                                                <small>Posts</small>
                                            </p>
                                        </li>
                                    @endif
                                    <li class="list-inline-item mr-3 text-center">
                                        <h5 class="mb-1">{{ count($user->comments) }}</h5>
                                        <p class="mb-0">
                                            <small>Comments</small>
                                        </p>
                                    </li>
                                    <li class="list-inline-item mr-3 text-center">
                                        <h5 class="mb-1">{{ count($user->reviews) }}</h5>
                                        <p class="mb-0">
                                            <small>Reviews</small>
                                        </p>
                                    </li>
                                    <li class="list-inline-item text-center">
                                        <h5 class="mb-1">{{ count($user->orders) }}</h5>
                                        <p class="mb-0">
                                            <small>Orders</small>
                                        </p>
                                    </li>
                                </ul>
                            </div> <!-- end media-body-->
                        </div>
                    </div> <!-- end col-->

                    <div class="col-sm-4">
                        <div class="text-center mt-sm-0 mt-3 text-sm-right">
                            <div class="dropdown">
                                <a class="text-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{!! route('admin.users.profile', ['slug' => $user->slug]) !!}">
                                        <i class="fas fa-user"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="{!! route('admin.users.edit', ['slug' => $user->slug]) !!}">
                                        <i class="fas fa-cog"></i>
                                        Settings
                                    </a>
                                    @if (Auth::user()->role_id == 1)
                                        <a class="dropdown-item" href="{!! route('admin.users.activities', ['slug' => $user->slug]) !!}">
                                            <i class="fas fa-signature"></i>
                                            Activities
                                        </a>
                                        <a class="dropdown-item text-warning" href="#">
                                            <i class="fas fa-user-minus"></i>
                                            Suspend
                                        </a>
                                        <a class="dropdown-item text-danger" href="#">
                                            <i class="fas fa-user-slash"></i>
                                            Remove
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row -->

            </div> <!-- end card-body/ profile-user-box-->
        </div>
    </div>
</div>
