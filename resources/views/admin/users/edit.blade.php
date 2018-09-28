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
                            <a href="{!! route('admin.users.profile', ['slug' => $user->slug]) !!}" class="btn btn-primary btn-sm btn-block">
                                <i class="fas fa-user mr-1"></i>
                                Profile
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
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h6 class="heading mb-3">Profile</h6>
                <form class="" action="index.html" method="post">
                    <div class="row">
                        <div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }} col">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="{{ $user->profile->first_name }}">
                            @if ($errors->has('first_name'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('first_name') }}</strong></small>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }} col">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="{{ $user->profile->last_name }}">
                            @if ($errors->has('last_name'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('last_name') }}</strong></small>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('avatar') ? ' has-danger' : '' }} row">
                        <div class="col-2 text-center">
                            <img src="{!! asset($user->profile->avatar) !!}" style="height: 45px;" alt="" class="rounded-circle mt-3">
                        </div>
                        <div class="col">
                            <label for="avatar">Choose Avatar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="avatar">
                                <label class="custom-file-label" for="avatar">Choose file</label>
                            </div>
                            @if ($errors->has('avatar'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('avatar') }}</strong></small>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('job') ? ' has-danger' : '' }}">
                        <label for="job">Job Title</label>
                        <input type="text" name="job" id="job" class="form-control" placeholder="Job Title" value="{{ $user->profile->job }}">
                        @if ($errors->has('job'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('job') }}</strong></small>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('location') ? ' has-danger' : '' }}">
                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" class="form-control" placeholder="Location" value="{{ $user->profile->location }}">
                        @if ($errors->has('location'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('location') }}</strong></small>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('bio') ? ' has-danger' : '' }}">
                        <label for="bio">Bio</label>
                        <textarea name="bio" class="form-control" id="bio">{{ $user->profile->bio }}</textarea>
                        @if ($errors->has('bio'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('bio') }}</strong></small>
                            </span>
                        @endif
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h6 class="heading mb-3">Account</h6>
                <form class="" action="index.html" method="post">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label for="name">Username</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Username" value="{{ $user->name }}">
                        @if ($errors->has('name'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('name') }}</strong></small>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <label for="email">Email Address <span class="badge badge-primary">Primary</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" value="{{ $user->email }}">
                        @if ($errors->has('email'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('email') }}</strong></small>
                            </span>
                        @endif
                    </div>
                    @if (Auth::user()->role_id === 1)
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="custom-select" name="role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        @if ($user->role_id == $role->id)
                                            selected
                                        @endif>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('role'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('role') }}</strong></small>
                                </span>
                            @endif
                        </div>
                    @endif
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6 class="heading mb-3">Password & Security</h6>
                <form class="" action="index.html" method="post">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email Address">
                        <span class="text-muted form-text">
                            <small>Confirm your email address</small>
                        </span>
                        @if ($errors->has('email'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('email') }}</strong></small>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <label for="password">New Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="New Password">
                        @if ($errors->has('password'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('password') }}</strong></small>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('confirm_password') ? ' has-danger' : '' }}">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                        @if ($errors->has('confirm_password'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('confirm_password') }}</strong></small>
                            </span>
                        @endif
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection