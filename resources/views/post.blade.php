@extends('layouts.public.app')

@section('content')
    <!-- ##### Blog Wrapper Area Start ##### -->
    <div class="single-blog-wrapper">

        <!-- Single Blog Post Thumb -->
        <div class="single-blog-post-thumb" style="background-image: url({{ asset($post->media->url) }})">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-left">
                        <h1 class="text-white">{{ $post->title }}</h1>
                        <div class="text-white">
                            By <a class="text-primary" href="{!! route('blog', ['author' => $post->user->slug]) !!}">{{ $post->user->name }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-4 justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="text-center">
                        <span>By</span>
                        <a class="text-primary" href="{!! route('blog', ['author' => $post->user->slug]) !!}">
                            <strong>{{ $post->user->name }}</strong>
                        </a>
                        <span class="mx-3">|</span>
                        <span>{{ $post->created_at->format("F j, Y - g:i a") }}</span>
                        <span class="mx-3">|</span>
                        @foreach ($post->categories as $category)
                            <span>
                                <a class="text-primary" href="{!! route('blog', ['category' => $category->slug]) !!}">{{ $category->name }}</a>
                            </span>,
                        @endforeach
                        <span class="mx-3">|</span>
                        <span>Comments</span>
                        <span>
                            <strong>{{ count($post->comments) }}</strong>
                        </span>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="regular-page-content-wrapper section-padding-80">
                        <div class="regular-page-title mb-4">
                            <h1>{{ $post->title }}</h1>
                        </div>
                        <div class="regular-page-text">
                            {!! $post->content !!}
                        </div>
                        <div class="post-tags py-5 mt-5">
                            <h6 class="mb-4">Tags</h6>
                            @foreach ($post->tags as $tag)
                                <a href="{!! route('blog', ['tag' => $tag->slug]) !!}" class="badge badge-blog badge-pill">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
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
                            <div class="comments mb-5">
                                @foreach ($post->comments as $comment)
                                    @if ($comment->approved)
                                        <div class="comment mb-4">
                                            <h6>{{ $comment->name }}</h6>
                                            <span class="text-muted">
                                                <small>{{ $comment->created_at->diffForHumans() }}</small>
                                            </span>
                                            <p class="mt-3">
                                                {{ $comment->content }}
                                            </p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="comment-form">
                                <h5>Leave a Comment</h5>
                                <div class="text-muted">
                                    Your email address will not be published. Required fields are marked *
                                </div>
                                @if ($dsettings->discussion_auth)
                                    <form class="comment-form mt-5" action="{!! route('blog.comment.store', ['id' => $post->id]) !!}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="comment">Comment</label>
                                            <textarea name="comment" class="form-control" id="comment" placeholder="Comment" style="min-height: 200px;"></textarea>
                                            @if ($errors->has('comment'))
                                                <span class="text-danger form-text" role="alert">
                                                    <small>{{ $errors->first('comment') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        @if ($dsettings->discussion_full)
                                            @guest
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label for="name">Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                                                        @if ($errors->has('name'))
                                                            <span class="text-danger form-text" role="alert">
                                                                <small>{{ $errors->first('name') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="col">
                                                        <label for="email">Email Address <span class="text-danger">*</span></label>
                                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
                                                        @if ($errors->has('email'))
                                                            <span class="text-danger form-text" role="alert">
                                                                <small>{{ $errors->first('email') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endguest
                                        @endif
                                        <div class="form-group mt-5">
                                            <button type="submit" class="btn btn-dark">Post Comment</button>
                                        </div>
                                    </form>
                                @else
                                    <div class="lead">
                                        <a href="{!! route('login') !!}">Log</a> or <a href="{!! route('register') !!}">register</a> to leave a reply.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- ##### Blog Wrapper Area End ##### -->
@endsection
