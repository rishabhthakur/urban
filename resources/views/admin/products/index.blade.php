@extends('layouts.admin.app')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="float-left mt-1">
                <strong>Showing total of {{ count($products) }}</strong>
            </div>
            <div class="float-right text-right">
                <a href="{!! route('admin.products.create') !!}" class="btn btn-primary">
                    <i class="fas fa-cart-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card table-responsive">
                @if (count($products) > 0)
                    <table class="table rounded bg-white">
                        <thead>
                            <tr>
                                <th scope="col" width="10%" class="text-center">
                                    <i class="fas fa-image"></i>
                                </th>
                                <th scope="col">Product</th>
                                <th scope="col" class="text-center">Stock</th>
                                <th scope="col" class="text-center">Price</th>
                                <th scope="col">Categories</th>
                                <th scope="col">Tags</th>
                                <th scope="col" width="15%">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="align-middle text-center">
                                        <img src="{{ asset($product->medias->first()->url) }}" alt="{{ $product->name }}" style="width: 100%;">
                                    </td>
                                    <td>
                                        <a href="{!! route('admin.products.edit', ['id' => $product->id]) !!}" class="text-dark">
                                            <span class="text-muted">{{ $product->brand->name }}</span>
                                            <h6>
                                                <strong>{{ $product->name }}</strong>
                                            </h6>
                                        </a>
                                        <small>
                                            <span class="text-muted">ID: <strong>#{{ $product->p_id }}</strong></span>
                                            <span class="mx-1">|</span>
                                            <span class="text-muted">SKU: <strong>@if ($product->sku) {{ $product->sku }} @else N/A @endif</strong></span>
                                        </small>
                                        <ul class="nav justify-content-start">
                                            <li class="nav-item">
                                                <a class="nav-link pl-0" target="_blank" href="{!! route('product', ['slug' => $product->slug]) !!}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{!! route('admin.products.edit', ['id' => $product->id]) !!}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                    <td class="text-center">
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
                                    <td class="text-center">
                                        @if ($product->sale_price)
                                            <div class="text-dark mb-1">
                                                <strike>${{ $product->regular_price }}</strike>
                                            </div>
                                            <div class="text-success">
                                                ${{ $product->sale_price }}
                                            </div>
                                        @else
                                            <div class="text-dark mb-1">
                                                <strong>${{ $product->regular_price }}</strong>
                                            </div>
                                        @endif
                                    </td>
                                    <td width="15%">
                                        <ul class="categorylist">
                                            @foreach ($product->categories as $category)
                                                <li>{{ $category->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td width="10%">
                                        @foreach ($product->tags as $tag)
                                            <span class="badge badge-secondary">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <small>
                                            <strong>Published</strong><br>
                                            {{ $product->created_at->format("F j, Y") }}
                                        </small>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="card-body">
                        No products found.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
