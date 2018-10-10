@extends('layouts.public.app')

@section('content')
  <!-- ##### Single Product Details Area Start ##### -->
  <section class="single_product_details_area d-flex align-items-center">

    <!-- Single Product Thumb -->
    <div class="single_product_thumb clearfix">
        @if (count($product->medias) > 1)
            <div class="product_thumbnail_slides owl-carousel">
                @foreach ($product->medias as $media)
                    <img src="{{ asset($media->url) }}" alt="{{ $product->name }}">
                @endforeach
            </div>
        @else
            <img src="{{ asset($product->medias->first()->url) }}" alt="{{ $product->name }}" width="100%">
        @endif
    </div>

    <!-- Single Product Description -->
    <div class="single_product_desc clearfix">
        <span>{{ $product->brand->name }}</span>
        <a href="cart.html">
            <h2>{{ $product->name }}</h2>
        </a>

        @if ($product->sale_price)
            <p class="product-price"><span class="old-price">${{ $product->regular_price }}</span> ${{ $product->sale_price }}</p>
        @else
            <p class="product-price">${{ $product->regular_price }}</p>
        @endif

        <p class="product-desc">
            {!! $product->description !!}
        </p>

        <!-- Form -->
        <form class="cart-form clearfix" action="{{ route('cart.add', ['id' => $product->id]) }}" method="POST">
            @csrf
            <!-- Select Box -->
            @if(count($product->attributes) > 0)
                <div class="select-box d-flex mt-50 mb-30">
                    @foreach ($product->attributes as $attribute)
                        <select name="attributes[]" id="productAttrb{{ $attribute->id }}" class="mr-5" required>
                            @foreach ($product->adata as $data)
                                @if ($attribute->id == $data->attribute->id)
                                    <option value="{{ $data->id }}">{{ $data->attribute->name }}: {{ $data->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    @endforeach
                    {{-- <select name="select" id="productColor">
                      <option value="value">Color: Black</option>
                      <option value="value">Color: White</option>
                      <option value="value">Color: Red</option>
                      <option value="value">Color: Purple</option>
                    </select> --}}
                </div>
            @endif
            <!-- Cart & Favourite Box -->
            <div class="cart-fav-box d-flex align-items-center mt-50 mb-30">
                <!-- Cart -->
                <button name="cart" type="submit" class="btn essence-btn"
                    @if ($product->quantity === 0)
                        disabled
                    @endif
                    >
                    @if ($product->quantity === 0)
                        Item out of stock
                    @else
                        Add to cart
                    @endif
                </button>
                <!-- Favourite -->
                <div class="product-favourite ml-4">
                    <button name="wishlist" type="submit" class="favme fa fa-heart btn btn-link @if ($wishlist) active @endif" formaction="{!! route('wishlist.add', ['id' => $product->id]) !!}" @if ($wishlist) disabled @endif></button>
                </div>
            </div>
        </form>
    </div>
  </section>
  <!-- ##### Single Product Details Area End ##### -->
@endsection
