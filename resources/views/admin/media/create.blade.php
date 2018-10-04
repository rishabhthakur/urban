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
                <form action="#" method="post" enctype="multipart/form-data"><input name="_token" value="jHP3sWeLwIUNKwclNdSszA49ytd06B6NLD6dpkAn" type="hidden">
                    <div class="form-group"><label for="dir_name">Directory Name</label> <input name="dir_name" id="dir_name" placeholder="Directory Name" class="form-control" type="text">
                        <div class="form-text"><span class="text-muted"><small>
                                    Directory names should be in lower case letters, should not contain spaces, should not contain special characters but can contain numbers.
                                </small></span></div>
                    </div>
                    <div class="form-group"><button type="submit" class="btn btn-outline-primary btn-sm">Create New Directory</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h6 class="heading mb-3">Directtory List</h6>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-action clearfix">
                        <div class="float-left pt-2 text-primary">
                            <i class="fas fa-folder display-2"></i>
                        </div>
                        <div class="float-left ml-3 pt-1">
                            <h4 class="m-0">products</h4>
                            <p class="m-0"><small><b>0 Items</b><br>
                                    October 2, 2018 - 7:56 pm
                                </small></p>
                        </div>
                        <div class="float-right"><a href="http://shopaholic.com/admin/directories/destroy/1" class="text-danger"><i class="dripicons-trash"></i></a></div>
                    </li>
                    <li class="list-group-item list-group-item-action clearfix">
                        <div class="float-left pt-2 text-primary">
                            <i class="fas fa-folder display-2"></i>
                        </div>
                        <div class="float-left ml-3 pt-1">
                            <h4 class="m-0">posts</h4>
                            <p class="m-0"><small><b>0 Items</b><br>
                                    October 2, 2018 - 7:56 pm
                                </small></p>
                        </div>
                        <div class="float-right"><a href="http://shopaholic.com/admin/directories/destroy/2" class="text-danger"><i class="dripicons-trash"></i></a></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
