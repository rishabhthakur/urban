@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body profile-user-box">

                <div class="row">
                    <div class="col-sm-10">
                        <div class="media">
                            <span class="float-left m-2 mr-4 text-center">
                                <img src="{!! asset($user->profile->avatar) !!}" style="height: 130px;" alt="" class="rounded-circle img-thumbnail">
                            </span>
                            <div class="media-body">

                                <h5 class="mb-0 text-primary">
                                    {{ $user->profile->first_name . ' ' . $user->profile->last_name}}
                                </h5>
                                <p>
                                    <span class="badge badge-primary">{{ $user->role->name }}</span><br>
                                    <span class="badge">
                                        <i class="fas fa-circle text-success mr-1"></i> Online
                                    </span>
                                </p>


                                <ul class="mb-0 list-inline">
                                    @if ($user->role_id <= 2)
                                        <li class="list-inline-item mr-3">
                                            <h5 class="mb-1 text-success">$1840</h5>
                                            <p class="mb-0">
                                                <small>Revenue</small>
                                            </p>
                                        </li>
                                        <li class="list-inline-item mr-3">
                                            <h5 class="mb-1">184</h5>
                                            <p class="mb-0">
                                                <small>Products</small>
                                            </p>
                                        </li>
                                    @endif
                                    <li class="list-inline-item mr-3">
                                        <h5 class="mb-1">184</h5>
                                        <p class="mb-0">
                                            <small>Posts</small>
                                        </p>
                                    </li>
                                    <li class="list-inline-item">
                                        <h5 class="mb-1">460</h5>
                                        <p class="mb-0">
                                            <small>Comments</small>
                                        </p>
                                    </li>
                                </ul>
                            </div> <!-- end media-body-->
                        </div>
                    </div> <!-- end col-->

                    <div class="col-sm-2">
                        <div class="text-center mt-sm-0 mt-3 text-sm-right">
                            <a href="{!! route('admin.users.edit', ['slug' => $user->slug]) !!}" class="btn btn-primary btn-sm btn-block">
                                <i class="fas fa-user-cog mr-1"></i>
                                Edit Profile
                            </a>
                            @if (Auth::user()->role_id == 1)
                                @if (!Auth::user())
                                    <button type="button" class="btn btn-warning btn-sm btn-block">
                                        <i class="fas fa-user-minus mr-1"></i>
                                        Suspend
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm btn-block">
                                        <i class="fas fa-user-times mr-1"></i>
                                        Remove
                                    </button>
                                @endif
                            @endif
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row -->

            </div> <!-- end card-body/ profile-user-box-->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h6 class="heading mb-3">Personal Information</h6>
                <p class="text-muted">
                    <small>
                        {{ $user->profile->bio }}
                    </small>
                </p>
                <hr>
                <div class="text-left">
                    <p>
                        <small><strong>Full Name:</strong></small><br />
                        <span>{{ $user->profile->first_name . ' ' . $user->profile->last_name }}</span>
                    </p>
                    <p>
                        <small><strong>Username:</strong></small><br />
                        <span>{{ $user->name }}</span>
                    </p>
                    <p>
                        <small><strong>Role:</strong></small><br />
                        <span>{{ $user->role->name }}</span>
                    </p>
                    <p>
                        <small><strong>Mobile:</strong></small><br />
                        <span>{{ $user->profile->phone }}</span>
                    </p>

                    <p>
                        <small><strong>Email:</strong></small><br />
                        <span>{{ $user->email }}</span>
                    </p>

                    <p>
                        <small><strong>Location:</strong></small><br />
                        <span>{{ $user->location }}</span>
                    </p>

                    <p>
                        <small><strong>Languages:</strong></small><br />
                        <span> English, German, Spanish </span>
                    </p>
                    <p class="mb-0">
                        <small><strong>Elsewhere:</strong></small>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h6 class="heading mb-3">Recent Activity</h6>
                <ul class="timeline">
                    @forelse ($user->activities->take(7) as $activity)
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
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover table-centered mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ASOS Ridley High Waist</td>
                            <td>$79.49</td>
                            <td><span class="badge badge-primary">82 Pcs</span></td>
                            <td>$6,518.18</td>
                        </tr>
                        <tr>
                            <td>Marco Lightweight Shirt</td>
                            <td>$128.50</td>
                            <td><span class="badge badge-primary">37 Pcs</span></td>
                            <td>$4,754.50</td>
                        </tr>
                        <tr>
                            <td>Half Sleeve Shirt</td>
                            <td>$39.99</td>
                            <td><span class="badge badge-primary">64 Pcs</span></td>
                            <td>$2,559.36</td>
                        </tr>
                        <tr>
                            <td>Lightweight Jacket</td>
                            <td>$20.00</td>
                            <td><span class="badge badge-primary">184 Pcs</span></td>
                            <td>$3,680.00</td>
                        </tr>
                        <tr>
                            <td>Marco Shoes</td>
                            <td>$28.49</td>
                            <td><span class="badge badge-primary">69 Pcs</span></td>
                            <td>$1,965.81</td>
                        </tr>
                    </tbody>
                </table>
            </div> <!-- end table responsive-->
        </div>
    </div>
</div>
@endsection
