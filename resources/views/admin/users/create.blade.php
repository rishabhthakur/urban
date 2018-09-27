@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h6 class="heading mb-3">Add New User</h6>
                <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="fromAdmin" value="1">
                    <div class="row">
                        <div class="form-group col">
                            <label for="first_name">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" required>
                            @if ($errors->has('first_name'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('first_name') }}</strong></small>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col">
                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" required>
                            @if ($errors->has('last_name'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('last_name') }}</strong></small>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="name">Username <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Username" required>
                            @if ($errors->has('name'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('name') }}</strong></small>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col">
                            <label for="email">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
                            @if ($errors->has('email'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('email') }}</strong></small>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            @if ($errors->has('password'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('password') }}</strong></small>
                                </span>
                            @endif
                        </div>
                        <div class="col">
                            <label>Password Generator</label>
                            <input type="text" class="form-control" value="{{ str_random(16) }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="job">Job Title</label>
                            <input type="text" name="job" id="job" class="form-control" placeholder="Job Title" value="">
                            @if ($errors->has('job'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('job') }}</strong></small>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control" placeholder="Location" value="">
                            @if ($errors->has('location'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('location') }}</strong></small>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        @if (Auth::user()->role_id === 1)
                            <div class="form-group col-md-6">
                                <label for="role">Role</label>
                                <select class="custom-select" name="role">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            @if ($role->id == 3)
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
