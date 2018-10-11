@extends('layouts.admin.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($order->error)
                        <div class="row mb-3">
                            <div class="col-12">
                                    <div class="my-1 rounded py-2 px-3 bg-danger text-white" role="alert">
                                        <strong>{{ $order->error }}</strong>
                                    </div>
                            </div>
                        </div>
                    @endif
                    <div class="row mb-5">
                        <div class="col-md-5 mb-4">
                            <h6 class="heading">Order <strong>#{{ $order->order_no }}</strong> details</h6>
                            <div class="mb-5">
                                Payment via <strong>Stripe</strong>
                            </div>
                            <h6>Order for <strong>{{ $order->bill_name }}</strong></h6>
                            <div>
                                <small>
                                    Please find below a cost-breakdown for the recent work completed. Please make payment at your earliest convenience, and do not hesitate to contact me with any questions.
                                </small>
                            </div>
                        </div>
                        <div class="col-md-3 offset-md-4 mb-4">
                            <div>
                                <strong>Order Date:</strong>
                            </div>
                            <span>{{ $order->created_at->format("F j, Y") }}</span>
                            <br>
                            <div class="mt-3">
                                <strong>Order Status:</strong>
                            </div>
                            @if ($order->shipped)
                                <span class="badge badge-success">Shipped</span>
                            @else
                                <span class="badge badge-warning">Pending</span>
                            @endif
                            <br>
                            <div class="mt-3">
                                <strong>Order ID:</strong>
                            </div>
                            <span>
                                #{{ $order->order_no }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-4 mb-5">
                            <h6>Billing Address</h6>
                            <div>
                                {{ $order->bill_address1 }} {{ $order->bill_address2 }}<br />
                                {{ $order->bill_town_city }}<br />
                                {{ $order->bill_province_state }}<br />
                                {{ $order->bill_country }}<br />
                                {{ $order->bill_postcode }}
                            </div>
                        </div>
                        <div class="col-md-6 offset-md-2 mb-5">
                            <div class="table-responsive">
                                <h6 class="heading">Purchase Items</h6>
                                @if (count($order->products) > 0)
                                    <table class="table table-hover table-centered mb-0">
                                        <tbody>
                                            @foreach ($order->products as $product)
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <strong>{{ $product->name }}</strong>
                                                        </div>
                                                        <div class="text-muted">
                                                            <span>
                                                                <small>
                                                                    ID: <strong>{{ $product->id }}</strong>
                                                                </small>
                                                            </span>
                                                            @if ($product->pivot->sale_price)
                                                                <span class="mx-1">|</span>
                                                                <span>
                                                                    <small>
                                                                        Was on sale for <strong>${{ $product->pivot->sale_price }}</strong>
                                                                    </small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($product->pivot->sale_price)
                                                            ${{ $product->pivot->sale_price }} x {{ $product->pivot->quantity }}
                                                        @else
                                                            ${{ $product->regular_price }} x {{ $product->pivot->quantity }}
                                                        @endif
                                                    </td>
                                                    <td class="text-right">
                                                        @if ($product->pivot->sale_price)
                                                            <strong>${{ $product->pivot->sale_price * $product->pivot->quantity }}</strong>
                                                        @else
                                                            <strong>${{ $product->regular_price * $product->pivot->quantity }}</strong>
                                                        @endif
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
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <small>
                                <strong>Note:</strong><br />
                                All accounts are to be paid within 7 days from receipt of invoice. To be paid by cheque or credit card or direct payment online. If account is not paid within 7 days the credits details supplied as confirmation of work undertaken will be charged the agreed quoted fee noted above.
                            </small>
                        </div>
                        <div class="col-md-3 offset-md-3">
                            <h6>Subtotal</h6>
                            <div class="mb-3">
                                ${{ $order->bill_subtotal }}
                            </div>
                            <h6>VAT (21%)</h6>
                            <div class="mb-3">
                                ${{ $order->bill_tax }}
                            </div>
                            <h6>Total</h6>
                            <h4 class="mb-3">
                                <strong>${{ $order->bill_total }}</strong>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
