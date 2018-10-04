@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form action="{!! route('admin.media.store') !!}" method="post" enctype="multipart/form-data" class="dropzone dz-clickable" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"
                    data-upload-preview-template="#uploadPreviewTemplate">
                    {{ csrf_field() }}
                    <div class="dz-message needsclick">
                        <i class="h1 text-muted fas fa-upload"></i>
                        <h5>Select a Directory &amp; Drop files here or click to upload.</h5>
                        <span class="text-muted font-13">(Maximum upload file size: <strong>3 MB</strong>.)</span>
                        <div class="form-group row justify-content-center">
                            <div class="col-md-4">
                                <label for="dir">Select Directory</label>
                                <select class="custom-select" name="dir" id="dir" required>
                                    @foreach($dirs as $dir)
                                    <option value="{{ $dir->id }}">{{ $dir->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h6 class="heading mb-3">Create New Directory</h6>
                <form action="{!! route('admin.directories.store') !!}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Directory Name</label>
                        <input name="name" id="name" placeholder="Directory Name" class="form-control" type="text">
                        @if ($errors->has('name'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('name') }}</strong></small>
                            </span>
                        @endif
                        <div class="form-text">
                            <span class="text-muted">
                                <small>
                                    Directory names should be in lower case letters, should not contain spaces, should not contain special characters but can contain numbers.
                                </small>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary btn-sm">Create New Directory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h6 class="heading mb-3">Directtory List</h6>
                <ul class="list-group">
                    @foreach ($dirs as $dir)
                        <li class="list-group-item list-group-item-action clearfix">
                            <div class="float-left pt-2 text-primary">
                                <i class="fas fa-folder display-2"></i>
                            </div>
                            <div class="float-left ml-3 pt-1">
                                <h4 class="m-0">{{ $dir->name }}</h4>
                                <p class="m-0">
                                    <small>
                                        <b>{{ count($dir->medias) }} Items</b><br>
                                        {{ $dir->created_at->format("F j, Y - g:i a") }}
                                    </small>
                                </p>
                            </div>
                            <div class="float-right">
                                <a href="#" class="text-danger">
                                    <i class="fas fa-delete"></i>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
