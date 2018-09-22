@extends('layouts.admin.app')

@section('content')
<form class="d-inline" action="index.html" method="post">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="heading mb-5">Add New Product</h6>
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <input type="text" name="name" id="name" class="form-control form-control-alternative" placeholder="Product Name" value="{{ old('name') }}" required>

                        @if ($errors->has('name'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('name') }}</strong></small>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} row mb-4">
                        <div class="col">
                            <label for="regular_price">Regular Price</label>
                            <input type="text" name="regular_price" id="regular_price" class="form-control form-control-alternative" placeholder="Regular Price" value="{{ old('regular_price') }}" required>

                            @if ($errors->has('regular_price'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('regular_price') }}</strong></small>
                                </span>
                            @endif
                        </div>
                        <div class="col">
                            <label for="sale_price">Sale Price</label>
                            <input type="text" name="sale_price" id="sale_price" class="form-control form-control-alternative" placeholder="Sale Price" value="{{ old('sale_price') }}" required>

                            @if ($errors->has('sale_price'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('sale_price') }}</strong></small>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Product Description</label>
                        <textarea name="description" class="form-control form-control-alternative" id="description" placeholder="Product Description">{{ old('description') }}</textarea>
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
                                    <input type="text" id="sku" name="sku" value="{{ old('sku') }}" class="form-control form-control-alternative" placeholder="Stock Keeping Unit">
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
                                    <label for="quantity">Stock Quantity</label>
                                    <input type="number" id="quantity" min="0" name="quantity" value="{{ old('quantity') }}" class="form-control form-control-alternative">
                                    @if ($errors->has('quantity'))
                                        <span class="text-danger form-text" role="alert">
                                            <small><strong>{{ $errors->first('quantity') }}</strong></small>
                                        </span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="stock_status">Stock Status</label>
                                    <select id="stock_status" class="custom-select form-control-alternative" name="stock_status" id="stock_status">
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
                                    <input type="number" id="weight" name="weight" class="form-control form-control-alternative" value="{{ old('weight') }}" min="0" placeholder="Weight (Kg)">
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
                                    <input type="number" id="length" name="length" class="form-control form-control-alternative" value="{{ old('length') }}" min="0" placeholder="Length">
                                    @if ($errors->has('length'))
                                        <span class="text-danger form-text" role="alert">
                                            <small><strong>{{ $errors->first('length') }}</strong></small>
                                        </span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="width">Width</label>
                                    <input type="number" id="width" name="width" class="form-control form-control-alternative" value="{{ old('width') }}" min="0" placeholder="Width">
                                    @if ($errors->has('width'))
                                        <span class="text-danger form-text" role="alert">
                                            <small><strong>{{ $errors->first('width') }}</strong></small>
                                        </span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="height">Height</label>
                                    <input type="number" id="height" name="height" class="form-control form-control-alternative" value="{{ old('height') }}" min="0" placeholder="Height">
                                    @if ($errors->has('height'))
                                        <span class="text-danger form-text" role="alert">
                                            <small><strong>{{ $errors->first('height') }}</strong></small>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                            <p class="description">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                            <p class="description">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="short_description">Product Short Description</label>
                        <textarea name="short_description" class="form-control form-control-alternative" id="short_description" placeholder="Product Short Description" style="height: 200px;">{{ old('short_description') }}</textarea>
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
                    <h6 class="heading mb-5">Product Image</h6>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <span class="text-muted form-text">
                        <small>Add product image or set multiple images for product gallery.</small>
                    </span>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6 class="heading mb-5">Product Brand</h6>
                    <select id="brand" class="custom-select form-control-alternative" name="brand" id="brand">
                        <option selected value="1">Unbrabded</option>
                    </select>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="#">
                        <i class="fas fa-plus"></i> Add new brand
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6 class="heading mb-5">Product Categories</h6>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1"> Uncategorized</label>
                    </div>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="#">
                        <i class="fas fa-plus"></i> Add new category
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6 class="heading mb-5">Product Tags</h6>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1"> Default Tag</label>
                    </div>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="#">
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
            themes: "modern",
            menubar: false,
            mobile: {
                theme: 'mobile',
                plugins: [ 'autosave', 'lists', 'autolink' ]
            }
        });
    </script>
@endsection
