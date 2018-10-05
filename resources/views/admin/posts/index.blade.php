@extends('layouts.admin.app')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="float-left mt-1">
                <strong>Showing total of {{ count($posts) }}</strong>
            </div>
            <div class="float-right text-right">
                <a href="{!! route('admin.posts.create') !!}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card table-responsive">
                @if (count($posts) > 0)
                    <table class="table rounded bg-white">
                        <thead>
                            <tr>
                                <th scope="col" width="40%">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Categories</th>
                                <th scope="col">Tags</th>
                                <th scope="col">
                                    <i class="fas fa-comments"></i>
                                </th>
                                <th scope="col" width="15%">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>
                                        <div class="mb-2">
                                            <a target="_blank" href="{!! route('blog.post', ['slug' => $post->slug]) !!}">
                                                <strong>
                                                    {{ $post->title }}
                                                </strong>
                                            </a>
                                        </div>
                                        <div class="dropdown">
                                            <a class="text-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="{!! route('blog.post', ['slug' => $post->slug]) !!}">View</a>
                                                <a class="dropdown-item" href="{!! route('admin.posts.edit', ['id' => $post->id]) !!}">Edit</a>
                                                <a class="dropdown-item text-danger" href="#">Trash</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{!! route('admin.users.profile', ['slug' => $post->user->slug]) !!}">
                                            {{ $post->user->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @foreach ($post->categories as $category)
                                            <span>{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($post->tags as $tag)
                                            <span class="badge badge-secondary">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        1 {{-- {{ count($post->comments) }} --}}
                                    </td>
                                    <td>
                                        <small>
                                            <strong>Published</strong><br>
                                            {{ $post->created_at->format("F j, Y") }}
                                        </small>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="card-body">
                        No posts found.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
