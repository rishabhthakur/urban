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
                    @if (count($user->products) > 0)
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
                                @foreach ($user->products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            @if ($product->sale_price)
                                                <div class="text-success">
                                                    <span class="badge badge-success">SALE</span> ${{ $product->sale_price }}
                                                </div>
                                            @else
                                                <div class="text-dark mb-1">
                                                    <strong>${{ $product->regular_price }}</strong>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($product->quantity)
                                                <span class="badge @if($product->quantity < 2) badge-danger @else badge-primary @endif">
                                                    {{ $product->quantity }} PCS
                                                </span>
                                            @else
                                                @if ($product->stock_status)
                                                    <span class="badge badge-success">
                                                        In stock
                                                    </span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            $6,518.18
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="card-body text-muted">
                            No products found.
                        </div>
                    @endif
                </div> <!-- end table responsive-->
            </div>
        </div>
    </div>
@endsection
