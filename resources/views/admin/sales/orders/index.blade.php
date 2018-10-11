@extends('layouts.admin.app')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="float-left mt-1">
                <strong>Showing total of {{ count($orders) }}</strong>
            </div>
            <div class="float-right text-right">
                <div class="dropdown">
                    <a class="btn btn-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @switch(request()->sort)
                            @case('pending')
                                Pending
                                @break
                            @case('shipped')
                                Shipped
                                @break
                            @case('canceled')
                                Canceled
                                @break
                            @default
                                All
                        @endswitch
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item @if (request()->sort == null || request()->sort == 'all') active @endif" href="{!! route('admin.posts', ['sort' => 'all']) !!}">All</a>
                        <a class="dropdown-item @if (request()->sort == 'pending') active @endif" href="{!! route('admin.posts', ['sort' => 'pending']) !!}">Pending</a>
                        <a class="dropdown-item @if (request()->sort == 'shipped') active @endif" href="{!! route('admin.posts', ['sort' => 'shipped']) !!}">Shipped</a>
                        <a class="dropdown-item @if (request()->sort == 'canceled') active @endif" href="{!! route('admin.posts', ['sort' => 'canceled']) !!}">Canceled</a>
                    </div>
                </div>
                <a href="{!! route('admin.products.create') !!}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card table-responsive">
                @if (count($orders) > 0)
                    <table class="table rounded bg-white">
                        <thead>
                            <tr>
                                <th scope="col">Order</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col" width="15%" class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <a href="{!! route('admin.sales.orders.show', ['id' => $order->order_no]) !!}" class="text-dark">
                                            <h6>
                                                <strong>#{{ $order->order_no }}</strong>
                                            </h6>
                                        </a>
                                        <small>
                                            <span class="text-muted">ID: <strong>#{{ $order->id }}</strong></span>
                                            <span class="mx-1">|</span>
                                            <span class="text-muted">Customer: <strong>{{ $order->user->name }}</strong></span>
                                        </small>
                                    </td>
                                    <td>
                                        {{ $order->created_at->format("F j, Y") }}<br />
                                        <span class="text-muted">{{ $order->created_at->format("g:i a") }}</span>
                                    </td>
                                    <td>
                                        @if ($order->shipped)
                                            <span class="badge badge-success">
                                                Shipped
                                            </span>
                                        @else
                                            <span class="badge badge-warning">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        ${{ $order->bill_total }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="card-body">
                        No orders found.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
