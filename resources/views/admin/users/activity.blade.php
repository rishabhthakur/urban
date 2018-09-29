@extends('layouts.admin.app')

@section('content')
    @include('admin.users.includes.profile-header')
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
