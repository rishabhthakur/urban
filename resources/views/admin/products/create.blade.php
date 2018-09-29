@extends('layouts.admin.app')

@section('content')
<form class="d-inline" action="{!! route('admin.products.store') !!}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="heading mb-5">Add New Product</h6>
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" id="name" class="form-control form-control" placeholder="Product Name" value="{{ old('name') }}" required>

                        @if ($errors->has('name'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('name') }}</strong></small>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('regular_price') ? ' has-danger' : '' }} row mb-4">
                        <div class="col">
                            <label for="regular_price">Regular Price</label>
                            <input type="text" name="regular_price" id="regular_price" class="form-control form-control" placeholder="Regular Price" value="{{ old('regular_price') }}" required>

                            @if ($errors->has('regular_price'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('regular_price') }}</strong></small>
                                </span>
                            @endif
                        </div>
                        <div class="col">
                            <label for="sale_price">Sale Price</label>
                            <input type="text" name="sale_price" id="sale_price" class="form-control form-control" placeholder="Sale Price" value="{{ old('sale_price') }}" required>

                            @if ($errors->has('sale_price'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('sale_price') }}</strong></small>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Product Description</label>
                        <textarea name="description" class="form-control form-control" id="description" placeholder="Product Description">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="nav-wrapper pt-0">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
                            <i class="fas fa-clipboard mr-1"></i>
                            Inventory
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
                            <i class="fas fa-truck mr-1"></i>
                            Shipping
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">
                            <i class="fas fa-asterisk mr-1"></i>
                            Attributes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false">
                            <i class="fas fa-cog mr-1"></i>
                            Advanced
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="sku">SKU</label>
                                    <input type="text" id="sku" name="sku" value="{{ old('sku') }}" class="form-control form-control" placeholder="Stock Keeping Unit">
                                    <span class="text-muted form-text">
                                        <small>SKU refers to a Stock-keeping unit, a unique identifier for each distinct product and service that can be purchased.</small>
                                    </span>
                                    @if ($errors->has('sku'))
                                        <span class="text-danger form-text" role="alert">
                                            <small><strong>{{ $errors->first('sku') }}</strong></small>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="mstock">Manage Stock?</label>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="mstock">
                                        <label class="custom-control-label" for="mstock">Enable stock management at product level</label>
                                    </div>
                                </div>
                                <div id="sqty" class="col">
                                    <label for="quantity">Stock Quantity</label>
                                    <input type="number" id="quantity" min="0" name="quantity" value="{{ old('quantity') }}" class="form-control form-control">
                                    @if ($errors->has('quantity'))
                                        <span class="text-danger form-text" role="alert">
                                            <small><strong>{{ $errors->first('quantity') }}</strong></small>
                                        </span>
                                    @endif
                                </div>
                                <div id="ssts" class="col">
                                    <label for="stock_status">Stock Status</label>
                                    <select id="stock_status" class="custom-select form-control" name="stock_status" id="stock_status">
                                        <option selected value="1">In stock</option>
                                        <option value="0">Out of stock</option>
                                    </select>
                                    @if ($errors->has('stock_status'))
                                        <span class="text-danger form-text" role="alert">
                                            <small><strong>{{ $errors->first('stock_status') }}</strong></small>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="weight">Weight (Kg)</label>
                                    <input type="number" id="weight" name="weight" class="form-control form-control" value="{{ old('weight') }}" min="0" placeholder="Weight (Kg)">
                                    @if ($errors->has('weight'))
                                        <span class="text-danger form-text" role="alert">
                                            <small><strong>{{ $errors->first('weight') }}</strong></small>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="dimensions">Dimensions (m)</label>
                                </div>
                                <div class="col">
                                    <label for="length">Length</label>
                                    <input type="number" id="length" name="length" class="form-control form-control" value="{{ old('length') }}" min="0" placeholder="Length">
                                    @if ($errors->has('length'))
                                        <span class="text-danger form-text" role="alert">
                                            <small><strong>{{ $errors->first('length') }}</strong></small>
                                        </span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="width">Width</label>
                                    <input type="number" id="width" name="width" class="form-control form-control" value="{{ old('width') }}" min="0" placeholder="Width">
                                    @if ($errors->has('width'))
                                        <span class="text-danger form-text" role="alert">
                                            <small><strong>{{ $errors->first('width') }}</strong></small>
                                        </span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="height">Height</label>
                                    <input type="number" id="height" name="height" class="form-control form-control" value="{{ old('height') }}" min="0" placeholder="Height">
                                    @if ($errors->has('height'))
                                        <span class="text-danger form-text" role="alert">
                                            <small><strong>{{ $errors->first('height') }}</strong></small>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                            <div class="bg-danger p-3 text-white rounded mb-3">
                                Product attributes function disabled.
                            </div>
                            <p class="text-muted">
                                Attribute must be selected in order for child attributes to be registered.
                            </p>
                            @forelse ($attributes as $attribute)
                                <div class="border rounded mb-2">
                                    <div class="p-2 border-bottom">
                                        <h6 class="mb-0 text-uppercase">{{ $attribute->name }}</h6>
                                    </div>
                                    <div class="px-2 py-3 attrbs-container">
                                        @forelse ($attribute->children as $child)
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input" name="attrb[]" id="attrb{{ $child->id }}" value="{{ $child->name }}" disabled>
                                                <label class="custom-control-label" for="attrb{{ $child->id }}">
                                                    <strong>{{ $child->name }}</strong>
                                                </label>
                                            </div>
                                        @empty
                                            <span class="text-muted">
                                                No related attributes found.
                                            </span>
                                        @endforelse
                                    </div>
                                </div>
                            @empty
                                <span class="text-muted">
                                    No attributes found.
                                </span>
                            @endforelse
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                            <p class="description">
                                <div class="form-group">
                                    <label for="purachase_note">Purchase Note (Optional)</label>
                                    <textarea name="purchase_note" class="form-control" id="purachase_note" placeholder="Purchase Note"></textarea>
                                    <span class="text-muted form-text">
                                        <small>
                                            Enter an optional note to send the customer after purchase.
                                        </small>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="reviews" value="1">
                                        <label class="custom-control-label" for="reviews">Enable Reviews</label>
                                    </div>
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="short_description">Product Short Description</label>
                        <textarea name="short_description" class="form-control form-control" id="short_description" placeholder="Product Short Description" style="height: 200px;">{{ old('short_description') }}</textarea>
                        @if ($errors->has('short_description'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('short_description') }}</strong></small>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="heading mb-5">Publish</h6>
                    <div class="status">
                        <label>Status</label>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" checked id="customCheck1">
                            <label class="custom-control-label" for="customCheck1"> Live</label>
                        </div>
                        <span class="text-muted form-text">
                            <small>Uncheck cancel</small>
                        </span>
                        <hr>
                        <label>Visibilty</label>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" checked id="customCheck1">
                            <label class="custom-control-label" for="customCheck1"> Public</label>
                        </div>
                        <span class="text-muted form-text">
                            <small>Uncheck to hide product</small>
                        </span>
                        <hr>
                        <label>Published</label>
                        <div>
                            <label class="text-primary"> {{ date("F j, Y") }}</label>
                        </div>
                        <span class="text-muted form-text">
                            <small>immediately</small>
                        </span>
                        <div class="text-right mt-4 clearfix">
                            <button type="submit" class="btn btn-primary">Publish</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6 class="heading">Product Image</h6>
                    <div class="mb-3">
                        <a href="#" data-toggle="modal" data-target="#productImageModal">
                            Set product image
                        </a>
                    </div>
                    <span class="text-muted form-text">
                        <small>Add product image or set multiple images for product gallery.</small>
                    </span>
                </div>
            </div>
            <!-- Media modal -->
            <div class="modal fade" id="productImageModal" tabindex="-1" role="dialog" aria-labelledby="productImageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productImageModalLabel">Product Image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if (count($medias) > 0)
                                <select multiple="multiple" class="image-picker show-html" id="product-image" name="medias[]">
                                    @foreach ($medias as $media)
                                        <option data-img-src="{{ asset($media->url) }}" value="{{ $media->id }}">{{ $media->name }}</option>
                                    @endforeach
                                </select>
                                <hr>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="images" multiple="multiple" name="images[]">
                                    <label class="custom-file-label" for="images">Choose files</label>
                                </div>
                                <span class="text-muted form-text">
                                    <small>Upload new? You can upload multiple files at the same time.</small>
                                </span>
                            @else
                                <p>
                                    No media items found.
                                </p>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="images" multiple="multiple" name="images[]">
                                    <label class="custom-file-label" for="images">Choose files</label>
                                </div>
                                <span class="text-muted form-text">Upload new? You can upload multiple files at the same time.</span>
                            @endif
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6 class="heading mb-5">Product Brand</h6>
                    <select id="brand" class="custom-select form-control" name="brand" id="brand">
                        @forelse ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @empty
                            <option selected>No brands found.</option>
                        @endforelse
                    </select>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{!! route('admin.products.brands') !!}">
                        <i class="fas fa-plus"></i> Add new brand
                    </a>
                </div>
            </div>

            <vue-newcategory></vue-newcategory>

            <div class="card">
                <div class="card-body">
                    <h6 class="heading mb-3">Product Tags</h6>
                    @forelse ($tags as $tag)
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="tag{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}">
                            <label class="custom-control-label" for="tag{{ $tag->id }}"> {{ $tag->name }}</label>
                        </div>
                    @empty
                        <span class="text-muted">
                            No tags found.
                        </span>
                    @endforelse
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{!! route('admin.products.tags') !!}">
                        <i class="fas fa-plus"></i> Add new tag
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('new-product-js')
    <script>
        tinymce.init({
            selector: '#description',
            body_class: 'form-control',
            themes: "modern",
            menubar: false,
            mobile: {
                theme: 'mobile',
                plugins: [ 'autosave', 'lists', 'autolink' ]
            }
        });
    </script>

    <script type="text/javascript">
        $(function () {
            // Stock management selector
            if ($("#mstock").is(":checked")) {
                $("#ssts").show();
                $("#sqty").hide();
            } else {
                $("#sqty").hide();
            }
            $("#mstock").click(function () {
                if ($(this).is(":checked")) {
                    $("#sqty").show();
                    $("#ssts").hide();
                } else {
                    $("#sqty").hide();
                    $("#ssts").show();
                }
            });
            // Product attributes selector

            // Image picker initialization
            $("#product-image").imagepicker();
        });
    </script>
@endsection
