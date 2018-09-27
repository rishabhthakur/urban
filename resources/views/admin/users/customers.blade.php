@extends('layouts.admin.app')

@section('content')
<div class="row mb-4">
    <div class="col-12 text-right">
        <a href="#" class="btn btn-primary btn-sm">
            <i class="fas fa-user-plus mr-1"></i>
            Add New User
        </a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card table-responsive">
            <table class="table rounded bg-white">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" width="5%" class="text-center">Avatar</th>
                        <th scope="col" width="25%">Name</th>
                        <th scope="col" width="25%">Email</th>
                        <th scope="col" width="25%">Role</th>
                        <th scope="col" width="20%"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="align-middle">
                                <strong>
                                    {{ $user->id }}
                                </strong>
                            </td>
                            <td class="align-middle text-center">
                                <img src="{{ asset($user->profile->avatar) }}" alt="..." class="rounded-circle" style="width: 30px; height: 30px;">
                            </td>
                            <td class="align-middle">
                                <strong>
                                    {{ $user->profile->first_name . " " . $user->profile->last_name }}
                                </strong>
                            </td>
                            <td class="align-middle">
                                <a href="mailto:{{ Auth::user()->email }}">{{ $user->email }}</a>
                            </td>
                            <td class="align-middle">
                                @switch($user->role_id)
                                    @case($user->role_id == 1)
                                        <span class="badge badge-primary">Administrator</span>
                                        @break
                                    @case($user->role_id == 2)
                                        <span class="badge badge-info">Moderator</span>
                                        @break
                                    @case($user->role_id == 3)
                                        <span class="badge badge-warning">Editor</span>
                                        @break
                                    @default
                                        <span class="badge badge-success">Customer</span>
                                @endswitch
                            </td>
                            <td>
                                <ul class="nav justify-content-center">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{!! route('admin.users.profile', ['slug' => $user->slug]) !!}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{!! route('admin.users.activities', ['slug' => $user->slug]) !!}">
                                            <i class="fas fa-chart-line"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{!! route('admin.users.edit', ['slug' => $user->slug]) !!}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td width="20%">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
