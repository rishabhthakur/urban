@extends('auth.account.includes.layout', ['title' => 'Wishlist'])

@section('section')
    <div class="mb-4">
        <div class="checkout_details_area clearfix pr-5 mb-100">
            <div class="table-responsive">
                @if (count($wishlist) != 0)
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col"></th>
                                <th scope="col" class="text-center">Price</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wishlist as $item)
                                <tr>
                                    <td width="20%">
                                        <a href="{!! route('product', ['slug' => getProduct($item->p_id)->slug]) !!}">
                                            <img src="{!! asset(getProduct($item->p_id)->medias->first()->url) !!}" width="100%" />
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <div class="cart-title text-left">
                                            <div>
                                                <span class="badge text-muted px-0">{{ __(getProduct($item->p_id)->brand->name) }}</span>
                                            </div>
                                            <a href="{!! route('product', ['slug' => getProduct($item->p_id)->slug]) !!}" class="text-dark h6">
                                                <div>
                                                    <strong>{{ $item->name }}</strong>
                                                </div>
                                            </a>
                                            <br>
                                            @foreach ($item->attributes as $attrb)
                                                <span class="text-muted">
                                                    <small>{{ $attrb }}</small>
                                                </span><br />
                                            @endforeach
                                            <div>
                                                <small>
                                                    {{ __(getProduct($item->p_id)->quantity) }} items remaining
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <strong>${{ $item->price }}</strong>
                                    </td>
                                    <td class="align-middle text-right">
                                        <a href="{!! route('cart.remove', ['id' => $item->id]) !!}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        <br>
                                        <a href="{!! route('wishlist.add.cart', ['id' => $item->id]) !!}">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>Your wishlist is empty</h4>
                    <p>
                        Keep track of your favourite items using your wishlist.
                    </p>
                @endif
            </div>
            <div class="mt-5 d-flex justify-content-between flex-column flex-lg-row">
                <a href="{!! route('shop') !!}" class="btn btn-link text-muted px-0">
                    <i class="fa fa-chevron-left"></i> Continue Shopping
                </a>
            </div>
        </div>
    </div>
@endsection
