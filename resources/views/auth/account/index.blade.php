@extends('auth.account.includes.layout', ['title' => 'Account'])

@section('section')
    <div class="mb-4">
        @if (count($user->orders) > 0)
            <table class="table table-hover table-borderless">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Order #</th>
                        <th scope="col">Date</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->orders as $order)
                        <tr>
                            <th scope="row">
                                <a href="#"># {{ $order->no }}</a>
                            </th>
                            <td>{{ $order->created_at->formt("F j, Y") }}</td>
                            <td>{{ $order->bill_total }}</td>
                            <td>
                                @if ($order->shipped)
                                    <span class="badge badge-success">Shipped</span>
                                @else
                                    <span class="badge badge-success">Being Processed</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            You have no orders yet. <a href="{!! route('shop') !!}">Wanna go shopping</a>?
        @endif
    </div>
@endsection
