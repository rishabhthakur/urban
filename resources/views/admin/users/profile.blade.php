@extends('layouts.admin.app')

@section('content')
    @include('admin.users.includes.profile-header')
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
                            <span>{{ $user->profile->location }}</span>
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
                            @include('admin.includes.activity')
                        @empty
                            <span class="text-muted">No recent activity</span>
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
