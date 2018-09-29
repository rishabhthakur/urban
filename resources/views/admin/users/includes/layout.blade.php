@extends('layouts.admin.app')

@section('content')
<div class="row mb-4">
    <div class="col-12 text-right">
        <a href="{!! route('admin.users.create') !!}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            @forelse ($users as $user)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body clearfix">
                            <div class="dropdown float-right">
                                <a class="text-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{!! route('admin.users.profile', ['slug' => $user->slug]) !!}">Profile</a>
                                    <a class="dropdown-item" href="{!! route('admin.users.edit', ['slug' => $user->slug]) !!}">Settings</a>
                                    @if (Auth::user()->role_id == 1)
                                        <a class="dropdown-item" href="{!! route('admin.users.activities', ['slug' => $user->slug]) !!}">Activities</a>
                                        <a class="dropdown-item text-warning" href="#">Suspend</a>
                                        <a class="dropdown-item text-danger" href="#">Remove</a>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix">
                                <a class="float-left mr-3" href="#">
                                    <img class="rounded-circle" src="{!! asset($user->profile->avatar) !!}" style="width: 60px;height:60px;">
                                </a>
                                <div class="user-body">
                                    <h6 class="mb-0">
                                        <strong>{{ $user->profile->first_name . ' ' . $user->profile->last_name }}</strong>
                                    </h6>
                                    <span class="text-muetd">
                                        <small>{{ $user->email }}</small>
                                    </span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <span>ID: <strong>{{ $user->id }}</strong></span>
                                <span class="mx-1">|</span>
                                <span class="badge text-primary">{{ $user->role->name }}</span>
                                <span class="float-right">{{ $user->created_at }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    No users found.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
