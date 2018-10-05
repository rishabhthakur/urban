@extends('layouts.public.app')

@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Blog</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Blog Wrapper Area Start ##### -->
    <section class="blog-wrapper section-padding-80">
        <div class="container">
            <div class="row">
                <!-- Single Blog Area -->
                <div class="col-md-8 col-lg-9">
                    <div class="pr-5">
                        @forelse ($posts as $post)
                            <div class="single-blog-area mb-5">
                                <div class="post-img">
                                    <img src="{!! asset($post->media->url) !!}" alt="">
                                    <div class="post-date">
                                        <span class="date">
                                            22
                                        </span>
                                        <span class="m-year">
                                            Jan 2018
                                        </span>
                                    </div>
                                </div>
                                <!-- Blog Post Content -->
                                <div class="content">
                                    <!-- Post Title -->
                                    <div class="post-title">
                                        <a href="#">{{ $post->title }}</a>
                                    </div>
                                    @if ($post->excerpt)
                                        <p>
                                            {{ $post->excerpt }}
                                        </p>
                                    @else
                                        <p>
                                            {{ strip_tags(str_limit($post->content, $limit = 100, $end = '...')) }}
                                        </p>
                                    @endif
                                    <div class="post-info">
                                        <span class="d-flex pr-4 my-4">
        									<span>
        										<span class="text-muted">By</span>
                                                <a href="#">
                                                    <strong> {{ $post->user->name }}</strong>
                                                </a>
        										<span class="mx-2 text-muted">|</span>
        									</span>

        									<span>
                                                @foreach ($post->categories as $category)
                                                    {{ $category->name . ',' }}
                                                @endforeach
        										<span class="mx-2 text-muted">|</span>
        									</span>

        									<span>
        										8 Comments
        									</span>
        								</span>
                                    </div>
                                    <a href="#">Continue reading <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        @empty
                            <p class="lead">
                                No posts found.
                            </p>
                        @endforelse
                    </div>
                </div>

                <!-- Sidebar Area -->
                <div class="col-md-4 col-lg-3">
                    <div class="blog-sidebar">
                        <div class="blog-sidebar-item">
                            <h4 class="mb-4">Categories</h4>
                            <ul class="list-group list-group-flush list-group-flush-sidebar">
                                @foreach ($categories as $category)
                                    <li class="list-group-item px-0">
                                        <a href="#">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="blog-sidebar-item">
                            <h4 class="mb-4">Tags</h4>
                            @foreach ($tags as $tag)
                                <a href="#" class="badge badge-blog badge-pill">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Blog Wrapper Area End ##### -->

@endsection
