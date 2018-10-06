@extends('layouts.admin.app')

@section('content')
<form class="d-inline" action="{!! route('admin.posts.store') !!}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="heading mb-5">Add New Blog Post</h6>
                    <div class="form-group">
                        <label for="title">Post Title</label>
                        <input type="text" name="title" id="title" class="form-control mb-5" placeholder="Post Title" value="{{ old('title') }}" required>

                        @if ($errors->has('title'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('title') }}</strong></small>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <textarea name="content" class="form-control" id="post_content">{{ old('content') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <label for="excerpt">Excerpt</label>
                            <textarea id="excerpt" name="excerpt" class="form-control" placeholder="Excerpt">{{ old('excerpt') }}</textarea>

                            @if ($errors->has('excerpt'))
                                <span class="text-danger form-text" role="alert">
                                    <small><strong>{{ $errors->first('excerpt') }}</strong></small>
                                </span>
                            @endif

                            <span class="text-muted form-text">
                                <small>
                                    Excerpts are optional hand-crafted summaries of your content that can be used in your theme. <a href="#">Learn more about manual excerpts</a>.
                                </small>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <label for="discussion">Discussion</label>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input"
                                @if ($dsettings->discussion)
                                    checked
                                @endif
                                id="discussion" name="discussion" value="1">
                                <label class="custom-control-label" for="discussion"> <strong>Allow comments</strong></label>
                            </div>
                            <label for="user_id">Author</label>
                            <select id="user_id" class="custom-select" name="user_id">
                                @foreach ($users as $user)
                                    <option
                                        @if (Auth::id() == $user->id)
                                            selected
                                        @endif
                                        value="{{ $user->id }}"
                                        >{{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
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
            <div class="card">
                <div class="card-body">
                    <h6 class="heading">Featured Image</h6>
                    <div class="featured-img">
                        <a href="#" data-toggle="modal" data-target="#PostImageModal">
                            Set featured image
                        </a>
                    </div>
                </div>
            </div>
            <!-- Media modal -->
            <div class="modal fade" id="PostImageModal" tabindex="-1" role="dialog" aria-labelledby="PostImageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="PostImageModalLabel">Featured Image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if (count($medias) > 0)
                                <select class="image-picker show-html" id="post-image" name="media">
                                    @foreach ($medias as $media)
                                        <option data-img-src="{{ asset($media->url) }}" value="{{ $media->id }}">{{ $media->name }}</option>
                                    @endforeach
                                </select>
                                <hr>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="images" multiple="multiple" name="image">
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
            <vue-newcategory to="{{ __('post') }}"></vue-newcategory>
            <!-- New Tag -->
            <vue-newtag to="{{ __('post') }}"></vue-newtag>
        </div>
    </div>
</form>
@endsection

@section('new-post-js')
    <script>
        tinymce.init({
            selector: '#post_content',
            themes: "modern",
            menubar: false,
            mobile: {
                theme: 'mobile',
                plugins: [ 'autosave', 'lists', 'autolink' ]
            }
        });
    </script>
@endsection

@section('new-post-js')
    <script type="text/javascript">
        // Image picker initialization
        $("#post-image").imagepicker();
    </script>
@endsection
