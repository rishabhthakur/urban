@extends('layouts.admin.app')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            @include('admin.settings.includes.nav')
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="heading mb-5">Media Settings</h6>
                    <h6>Image Resize</h6>
                    <div class="text-muted">
                        <small>The sizes listed below determine the maximum dimensions in pixels to use when adding an image to the Media Library.</small>
                    </div>
                    <hr>
                    <div class="mb-4">
                        &nbsp;
                    </div>
                    <h6>Uploading Files</h6>
                    <div class="text-muted">
                        <small>The sizes listed below determine the maximum dimensions in pixels to use when adding an image to the Media Library.</small>
                    </div>
                    <hr>
                    <form class="mb-5" action="{!! route('admin.settings.media.store') !!}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col">
                                <label for="product_dir">Default <strong>Products</strong> Media Upload Directory</label>
                                <select class="custom-select" name="product_dir" id="product_dir">
                                    @foreach ($dirs as $dir)
                                        <option
                                        @if ($dir->id == $settings->product_dir)
                                            selected
                                        @endif
                                         value="{{ $dir->id }}">{{ $dir->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-muted form-text">
                                    <small>
                                        All images associated with products that have been uploaded will be stored in this <strong>directory</strong>.
                                    </small>
                                </span>
                            </div>
                            <div class="col-6">
                                <label for="post_dir">Default <strong>Blog Post</strong> Media Upload Directory</label>
                                <select class="custom-select" name="post_dir" id="post_dir">
                                    @foreach ($dirs as $dir)
                                        <option
                                        @if ($dir->id == $settings->post_dir)
                                            selected
                                        @endif
                                         value="{{ $dir->id }}">{{ $dir->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-muted form-text">
                                    <small>
                                        All images associated with posts that have been uploaded will be stored in this <strong>directory</strong>.
                                    </small>
                                </span>
                            </div>
                        </div>
                        <div class="form-group mt-5 mb-0">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                    <h6>Create New Directory</h6>
                    <div class="text-muted form-text">
                        <small>
                            Directory names should be in lower case letters, should not contain spaces, should not contain special characters but can contain numbers.
                        </small>
                    </div>
                    <hr>
                    <form action="{!! route('admin.directories.store') !!}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="name">Directory Name</label>
                                <input name="name" id="name" placeholder="Directory Name" class="form-control" type="text">
                            </div>
                            @if ($errors->has('name'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('name') }}</strong></small>
                                </span>
                            @endif
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">Create New Directory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
