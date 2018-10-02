@extends('layouts.admin.app')

@section('content')
<form class="" action="index.html" method="post">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="heading mb-5">Add New Blog Post</h6>
                    <div class="form-group">
                        <label for="title">Post Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Post Title" value="{{ old('title') }}" required>

                        @if ($errors->has('title'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('title') }}</strong></small>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <textarea name="content" class="form-control" id="content">{{ old('content') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="heading mb-3">Publish</h6>
                    <div class="row">
                        <div class="col mb-3">
                            <div class="status">
                                <label>Status</label>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" checked id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1"> <strong>Publish</strong></label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1"> <strong>Draft</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <label>Visibilty</label>
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" checked id="customCheck1">
                                <label class="custom-control-label" for="customCheck1"> <strong>Public</strong></label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1"> <strong>Private</strong></label>
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
            <div class="card">
                <div class="card-body">
                    <h6 class="heading">Featured Image</h6>
                    <div class="mb-3">
                        <a href="#" data-toggle="modal" data-target="#productImageModal">
                            Set featured image
                        </a>
                    </div>
                </div>
            </div>
            <!-- Media modal -->
            <div class="modal fade" id="productImageModal" tabindex="-1" role="dialog" aria-labelledby="productImageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productImageModalLabel">Featured Image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if (count($medias) > 0)
                                <select class="image-picker show-html" id="product-image" name="medias[]">
                                    @foreach ($medias as $media)
                                        <option data-img-src="{{ asset($media->url) }}" value="{{ $media->id }}">{{ $media->name }}</option>
                                    @endforeach
                                </select>
                                <hr>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="images" multiple="multiple" name="images[]">
                                    <label class="custom-file-label" for="images">Choose files</label>
                                </div>
                            @else
                                <p>
                                    No media items found.
                                </p>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="images" name="image">
                                    <label class="custom-file-label" for="images">Choose files</label>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Set Featured</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New Category -->
            <vue-newpcategory></vue-newpcategory>
            <!-- New Tag -->
            <vue-newptag></vue-newptag>
        </div>
    </div>
</form>
@endsection

@section('new-post-js')
    <script>
        tinymce.init({
            selector: '#content',
            body_class: 'form-control',
            themes: "modern",
            menubar: false,
            mobile: {
                theme: 'mobile',
                plugins: [ 'autosave', 'lists', 'autolink' ]
            }
        });
    </script>
@endsection
