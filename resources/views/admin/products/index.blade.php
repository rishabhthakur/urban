@extends('layouts.admin.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="float-left mt-1">
            <strong>Showing total of {{ count($products) }}</strong>
        </div>
        <div class="float-right text-right">
            <a href="{!! route('admin.products.create') !!}" class="btn btn-primary btn-sm">
                <i class="fas fa-user-plus mr-1"></i>
                Add New Products
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card table-responsive">
            <table class="table rounded bg-white">
                <thead>
                    <tr>
                        <th scope="col" width="10%" class="text-center">
                            <i class="fas fa-image"></i>
                        </th>
                        <th scope="col">Product</th>
                        <th scope="col" class="text-center">SKU</th>
                        <th scope="col" class="text-center">Stock</th>
                        <th scope="col" class="text-center">Price</th>
                        <th scope="col">Categories</th>
                        <th scope="col">Tags</th>
                        <th scope="col" width="15%">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr @if ($product->quantity < 2) class="border-warning" @endif>
                            <td class="align-middle text-center">
                                <img src="{{ asset($product->medias->first()->url) }}" alt="{{ $product->name }}" style="width: 100%;">
                            </td>
                            <td>
                                <h6 class="text-dark">{{ $product->name }}</h6>
                                <small>
                                    <span class="text-muted">{{ $product->brand->name }}</span>
                                    <span class="mx-1">|</span>
                                    <span class="text-muted">ID: {{ $product->id }}</span>
                                </small>
                                <ul class="nav justify-content-start">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
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
                                {{ $product->sku }}
                            </td>
                            <td class="text-center">
                                @if ($product->quantity)
                                    <span class="badge @if($product->quantity < 2) badge-danger @else badge-success @endif">
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
                            <td width="10%">
                                @foreach ($product->categories as $category)
                                    <span class="text-primary"> {{ $category->name }},</span>
                                @endforeach
                            </td>
                            <td width="10%">
                                @foreach ($product->tags as $tag)
                                    <span class="badge badge-info">{{ $tag->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <p>
                                    <small>
                                        <strong>Published</strong><br>
                                        {{ $product->created_at->format("F j, Y") }}
                                    </small>
                                </p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td></td>
                            <td>No products found.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
