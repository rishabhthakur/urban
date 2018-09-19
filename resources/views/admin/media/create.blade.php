@extends('layouts.admin.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{!! route('admin.media.store') !!}" method="post" enctype="multipart/form-data" class="dropzone dz-clickable" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                    {{ csrf_field() }}
                        <div class="dz-message needsclick">
                            <i class="h1 text-muted dripicons-cloud-upload"></i>
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
@endsection
