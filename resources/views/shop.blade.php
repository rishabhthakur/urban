@extends('layouts.public.app')

@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Shop</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- ##### Single Widget ##### -->
                        <div class="widget catagory mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Catagories</h6>

                            <!--  Catagories  -->
                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content collapse show">
                                    <!-- Single Item -->
                                    @foreach ($categories as $category)
                                      <li>
                                          <a href="{!! route('shop', ['category' => $category->slug]) !!}">{{ $category->name }}</a>
                                          <ul class="sub-menu show" id="category{{ $category->id }}">
                                              @foreach ($category->children as $child)
                                                <li>
                                                  <a href="{!! route('shop', ['category' => $child->slug]) !!}">{{ $child->name }}</a>
                                                </li>
                                              @endforeach
                                          </ul>
                                      </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <div class="widget price mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Filter by</h6>
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Price</p>
                            <div class="widget-desc">
                                <div class="slider-range">
                                    <div data-min="49" data-max="360" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="49" data-value-max="360" data-label-result="Range:">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>
                                    <div class="range-price">Range: $49.00 - $360.00</div>
                                </div>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        @if (count($colors) > 0)
                            <div class="widget brands mb-50">
                                <!-- Widget Title 2 -->
                                <p class="widget-title2 mb-30">Color</p>
                                <div class="widget-desc">
                                    <ul>
                                        @foreach ($colors as $color)
                                          <li>
                                            <a href="#">{{ $color->name }}</a>
                                          </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <!-- ##### Single Widget ##### -->
                        <div class="widget brands mb-50">
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Brands</p>
                            <div class="widget-desc">
                                <ul>
                                    @foreach ($brands as $brand)
                                      <li>
                                        <a href="{!! route('shop', ['brand' => $brand->slug]) !!}">{{ $brand->name }}</a>
                                      </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p><span>{{ count($products) }}</span> products found</p>
                                    </div>
                                    <!-- Sorting -->
                                    <div class="product-sorting d-flex">
                                        <p>Sort by:</p>
                                        <div class="dropdown">
                                            <a class="text-uppercase dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                @switch(request()->sort)
                                                    @case('newest')
                                                        Newest
                                                        @break
                                                    @case('high_low')
                                                        Price: $$ - $
                                                        @break
                                                    @case('low_high')
                                                        Price: $ - $$
                                                        @break
                                                    @default
                                                        Highest Rated
                                                @endswitch
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item text-uppercase @if (request()->sort == null) active @endif" href="{!! route('shop', ['category' => request()->category, 'brand' => request()->brand, 'sort' => 'highest']) !!}">
                                                    Highest Rated
                                                </a>
                                                <a class="dropdown-item text-uppercase @if (request()->sort == null) selected @endif" href="{!! route('shop', ['category' => request()->category, 'brand' => request()->brand, 'sort' => 'newest']) !!}">
                                                    Newest
                                                </a>
                                                <a class="dropdown-item text-uppercase @if (request()->sort == null) selected @endif" href="{!! route('shop', ['category' => request()->category, 'brand' => request()->brand, 'sort' => 'high_low']) !!}">
                                                    Price: $$ - $
                                                </a>
                                                <a class="dropdown-item text-uppercase @if (request()->sort == null) selected @endif" href="{!! route('shop', ['category' => request()->category, 'brand' => request()->brand, 'sort' => 'low_high']) !!}">
                                                    Price: $ - $$
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                          @forelse ($products as $product)
                          <!-- Single Product -->
                          <div class="col-12 col-sm-6 col-lg-4">
                              <a href="{!! route('product', ['slug' => $product->slug]) !!}">
                                <div class="single-product-wrapper">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img src="{{ asset($product->medias->first()->slug) }}" alt="{{ $product->name }}">
                                        <!-- Hover Thumb -->
                                        <img class="hover-img" src="{{ asset($product->medias->last()->slug) }}" alt="{{ $product->name }}">

                                        <!-- Product Badge -->
                                        @if ($product->quantity === 0)
                                          <div class="product-badge offer-badge">
                                            <span>Out of stock</span>
                                          </div>
                                        @else
                                          @if($product->sale_price)
                                          <div class="product-badge new-badge">
                                            <span>-{{ __(salePercentage($product->regular_price, $product->sale_price)) }}%</span>
                                          </div>
                                          @endif
                                        @endif
                                        <!-- Favourite -->
                                        {{-- <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div> --}}
                                    </div>

                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <span>{{ $product->brand->name }}</span>
                                        <a href="single-product-details.html">
                                            <h6>{{ $product->name }}</h6>
                                        </a>
                                        @if($product->sale_price)
                                          <p class="product-price"><span class="old-price">{{ presentPrice($product->regular_price) }}</span> {{ presentPrice($product->sale_price) }}</p>
                                        @else
                                          <p class="product-price">{{ presentPrice($product->regular_price) }}</p>
                                        @endif

                                        <!-- Hover Content -->
                                        {{-- <div class="hover-content">
                                            <!-- Add to Cart -->
                                            <div class="add-to-cart-btn">
                                                <a href="{{ route('product.quick.add', ['id' => $product->id]) }}" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                              </a>
                          </div>
                          @empty
                            <p>
                              No products found.
                            </p>
                          @endforelse

                        </div>
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="navigation" class="justify-content-center">
                      {{ $products->appends(request()->input())->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->
@endsection
