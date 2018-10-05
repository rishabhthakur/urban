@extends('layouts.public.app')

@section('content')
    <!-- ##### Blog Wrapper Area Start ##### -->
    <div class="single-blog-wrapper">

        <!-- Single Blog Post Thumb -->
        <div class="single-blog-post-thumb">
            <img src="{!! asset($post->media->url) !!}" alt="{!! $post->title !!}">
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="regular-page-content-wrapper section-padding-80">
                        <div class="regular-page-title mb-4">
                            <h1>{{ $post->title }}</h1>
                        </div>
                        <div class="regular-page-text">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>
            </div>
            <span class="d-none">
                {{ $dsettings->discussion = $post->discussion }}
            </span>
            @if ($dsettings->discussion)
                <div class="row justify-content-center">
                    <div class="c-l12 col-md-8">
                        <div class="single-blog-commenting-area">
                            <h5>Leave a Comment</h5>
                            <div class="text-muted">
                                Your email address will not be published. Required fields are marked *
                            </div>
                            @if ($dsettings->discussion_auth)
                                <form class="comment-form mt-5" action="{!! route('blog.comment.store') !!}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="comment">Comment</label>
                                        <textarea name="comment" class="form-control" id="comment" placeholder="Comment" style="min-height: 200px;"></textarea>
                                    </div>
                                    @if ($dsettings->discussion_full)
                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="name">Name <span class="text-danger">*</span></label>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                                            </div>
                                            <div class="col">
                                                <label for="email">Email Address <span class="text-danger">*</span></label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-dark">Post Comment</button>
                                    </div>
                                </form>
                            @else
                                <div class="lead">
                                    <a href="{!! route('login') !!}">Log</a> or <a href="{!! route('register') !!}">register</a> in to leave a reply.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- ##### Blog Wrapper Area End ##### -->
@endsection
