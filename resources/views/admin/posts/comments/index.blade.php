@extends('layouts.admin.app')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="float-left mt-1">
                <strong>Showing total of {{ count($comments) }}</strong>
            </div>
            <div class="float-right text-right">
                <div class="dropdown">
                    <a class="btn btn-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @switch(request()->sort)
                            @case('pending')
                                Pending
                                @break
                            @case('approved')
                                Approved
                                @break
                            @case('trash')
                                Trash
                                @break
                            @default
                                All
                        @endswitch
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item @if (request()->sort == null || request()->sort == 'all') active @endif" href="{!! route('admin.posts.comments', ['sort' => 'all']) !!}">All</a>
                        <a class="dropdown-item @if (request()->sort == 'pending') active @endif" href="{!! route('admin.posts.comments', ['sort' => 'pending']) !!}">Pending</a>
                        <a class="dropdown-item @if (request()->sort == 'approved') active @endif" href="{!! route('admin.posts.comments', ['sort' => 'approved']) !!}">Approved</a>
                        <a class="dropdown-item @if (request()->sort == 'trash') active @endif" href="{!! route('admin.posts.comments', ['sort' => 'trash']) !!}">Trash</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card table-responsive">
                @if (count($comments) > 0)
                    <table class="table rounded bg-white">
                        <thead>
                            <tr>
                                <th scope="col" width="20%">Author</th>
                                <th scope="col" width="40%">Comment</th>
                                <th scope="col">In Response To</th>
                                <th scope="col" width="15%">Submitted On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>
                                        <div class="mb-1">
                                            <strong>{{ $comment->name }}</strong><br>
                                            @if ($comment->email)
                                                <a href="mailto:{{ $comment->email }}">{{ $comment->email }}</a>
                                            @endif
                                        </div>
                                        @if ($comment->approved)
                                            <span class="badge badge-success">Approved</span>
                                        @else
                                            <span class="badge badge-warning">Unapproved</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $comment->content }}
                                    </td>
                                    <td>
                                        <a href="{!! route('admin.posts.edit', ['id' => $comment->post->id]) !!}">
                                            <strong>{{ $comment->post->title }}</strong>
                                        </a>
                                    </td>
                                    <td>
                                        {{ $comment->created_at->format("F j, Y - g:i a") }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="card-body">
                        No comments found.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
