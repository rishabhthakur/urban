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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h6 class="heading mb-3">Activity Log</h6>
                <ul class="timeline">
                    @forelse ($user->activities as $activity)
                        <li>
                            <p>
                                <span class="badge badge-primary">{{ $activity->created_at->format("F j, Y") }}</span>
                            </p>
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
</div>
@endsection
