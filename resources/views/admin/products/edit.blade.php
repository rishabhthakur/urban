@extends('layouts.admin.app')

@section('content')
<form class="d-inline" action="{!! route('admin.products.update', ['id' => $product->id]) !!}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{-- Title --}}
                    <h6 class="heading mb-5">Add New Product</h6>

                    {{-- Product Name --}}
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Product Name" value="{{ $product->name }}" required>

                        @if ($errors->has('name'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('name') }}</strong></small>
                            </span>
                        @endif
                    </div>

                    {{-- Product Reular Price & Sale Price --}}
                    <div class="form-group{{ $errors->has('regular_price') ? ' has-danger' : '' }} row mb-4">
                        <div class="col">
                            <label for="regular_price">Regular Price</label>
                            <input type="text" name="regular_price" id="regular_price" class="form-control" placeholder="Regular Price" value="{{ $product->regular_price }}" required>

                            @if ($errors->has('regular_price'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('regular_price') }}</strong></small>
                                </span>
                            @endif
                        </div>
                        <div class="col">
                            <label for="sale_price">Sale Price</label>
                            <input type="text" name="sale_price" id="sale_price" class="form-control" placeholder="Sale Price" value="{{ $product->sale_price }}"  >

                            @if ($errors->has('sale_price'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('sale_price') }}</strong></small>
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Product Description --}}
                    <div class="form-group">
                        <label for="description">Product Description</label>
                        <textarea name="description" class="form-control" id="description" placeholder="Product Description">{{ $product->description }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Product Data Tabs --}}
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
                                    <input type="text" id="sku" name="sku" value="{{ $product->sku }}" class="form-control" placeholder="Stock Keeping Unit">
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
                                    <input type="number" id="quantity" min="0" name="quantity" value="{{ $product->quantity }}" class="form-control">
                                    @if ($errors->has('quantity'))
                                        <span class="text-danger form-text" role="alert">
                                            <small><strong>{{ $errors->first('quantity') }}</strong></small>
                                        </span>
                                    @endif
                                </div>
                                <div id="ssts" class="col">
                                    <label for="stock_status">Stock Status</label>
                                    <select id="stock_status" class="custom-select" name="stock_status" id="stock_status">
                                        <option @if ($product->status) selected @endif value="1">In stock</option>
                                        <option @if (!$product->status) selected @endif value="0">Out of stock</option>
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
                                    <input type="number" id="weight" name="weight" class="form-control" value="{{ $product->weight }}" min="0" placeholder="Weight (Kg)">
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
                                    <input type="number" id="length" name="length" class="form-control" value="{{ $product->length }}" min="0" placeholder="Length">
                                    @if ($errors->has('length'))
                                        <span class="text-danger form-text" role="alert">
                                            <small><strong>{{ $errors->first('length') }}</strong></small>
                                        </span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="width">Width</label>
                                    <input type="number" id="width" name="width" class="form-control" value="{{ $product->width }}" min="0" placeholder="Width">
                                    @if ($errors->has('width'))
                                        <span class="text-danger form-text" role="alert">
                                            <small><strong>{{ $errors->first('width') }}</strong></small>
                                        </span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="height">Height</label>
                                    <input type="number" id="height" name="height" class="form-control" value="{{ $product->height }}" min="0" placeholder="Height">
                                    @if ($errors->has('height'))
                                        <span class="text-danger form-text" role="alert">
                                            <small><strong>{{ $errors->first('height') }}</strong></small>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Add new attribute -->
                        <vue-newattribute
                            @if ($edit)
                                :attributes="{{ $product->attributes }}"
                                :terms="{{ $product->adata }}"
                                mode="edit"
                            @endif>
                        </vue-newattribute>
                        <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                            <p class="description">
                                <div class="form-group">
                                    <label for="purachase_note">Purchase Note (Optional)</label>
                                    <textarea name="purchase_note" class="form-control" id="purachase_note" placeholder="Purchase Note">{{ $product->purchase_note }}</textarea>
                                    <span class="text-muted form-text">
                                        <small>
                                            Enter an optional note to send the customer after purchase.
                                        </small>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="reviews" name="reviews" value="1"
                                        @if ($product->reviews)
                                            checked
                                        @endif>
                                        <label class="custom-control-label" for="reviews">Enable Reviews</label>
                                    </div>
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Product Short Description --}}
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="short_description">Product Short Description</label>
                        <textarea name="short_description" class="form-control" id="short_description" placeholder="Product Short Description" style="height: 200px;">{{ $product->short_description }}</textarea>
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

            {{-- Product Publishing --}}
            <div class="card">
                <div class="card-body">
                    <h6 class="heading mb-3">Publish</h6>
                    <div class="row">
                        <div class="col mb-3">
                            <div class="status">
                                <label>Status</label>
                               <div class="custom-control custom-radio mb-3">
                                    <input type="radio" id="status1" checked name="status" class="custom-control-input">
                                    <label class="custom-control-label" for="status1"> <strong>Publish</strong></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="status2" name="status" class="custom-control-input">
                                    <label class="custom-control-label" for="status2"> <strong>Draft</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <label>Visibilty</label>
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" id="visibility1" checked name="visibility" class="custom-control-input">
                                <label class="custom-control-label" for="visibility1"> <strong>Public</strong></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="visibility2" name="visibility" class="custom-control-input">
                                <label class="custom-control-label" for="visibility2"> <strong>Private</strong></label>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <label>Wiil be published</label>
                            <div>
                                <small>
                                    <strong>immediately</strong>
                                </small>
                            </div>
                            <div>
                                <span class="badge badge-primary">
                                    {{ date("F j, Y") }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-4 clearfix">
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </div>
                </div>
            </div>

            {{-- Product Image --}}
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
                                        <option
                                            data-img-src="{{ asset($media->url) }}"
                                            value="{{ $media->id }}"
                                            @foreach ($product->medias as $item)
                                                @if ($item->id == $media->id)
                                                    selected
                                                @endif
                                            @endforeach
                                            >
                                            {{ $media->name }}
                                        </option>
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

            <!-- New Brand -->
            <vue-newbrand
                @if ($edit)
                    :brnd="{{ $product->brand }}"
                @endif
                mode="edit"
                >
            </vue-newbrand>

            <!-- New Category -->
            <vue-newcategory
                to="{{ __('product') }}"
                @if ($edit)
                    :categories="{{ $product->categories }}"
                @endif
                mode="edit"
                >
            </vue-newcategory>

            <!-- New Tag -->
            <vue-newtag
                to="{{ __('product') }}"
                @if ($edit)
                    :tags="{{ $product->tags }}"
                @endif
                mode="edit"
                >
            </vue-newtag>
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

            // Image picker initialization
            $("#product-image").imagepicker();
        });
    </script>
@endsection
