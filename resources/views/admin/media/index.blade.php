@extends('layouts.admin.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bg-white mb-4 py-2 px-3 border">
                <div class="row">
                    <div class="col">
                        <small>
                            <strong>Showing {{ count($medias) }} media files.</strong>
                        </small>
                    </div>
                    <div class="col">
                        <div class="mb-0 d-flex justify-content-end">
                            <a href="{!! route('admin.media', ['view' => 'grid']) !!}" class="btn btn-link btn-sm @if (request()->view == 'grid') active @endif shadow-none">
                                <i class="fas fa-th-large"></i>
                            </a>
                            <a href="{!! route('admin.media', ['view' => 'list']) !!}" class="btn btn-link btn-sm @if (request()->view == 'list') active @endif shadow-none">
                                <i class="fas fa-th-list"></i>
                            </a>
                            <a href="{!! route('admin.media.create') !!}" class="btn btn-link btn-sm shadow-none">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (request()->view == 'list')
            <div class="col-12">
                <table class="table table-borderless">
                    <thead>
                        <tr class="bg-white">
                            <th scope="col">#</th>
                            <th scope="col">File</th>
                            <th scope="col">Author</th>
                            <th scope="col">Uploaded to</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($medias as $media)
                            <tr>
                                <th scope="row">1</th>
                                <td width="40%">
                                    <a href="#" data-toggle="modal" data-target=".modal{{ $media->id }}">
                                        <img src="{!! asset($media->url) !!}" alt="{!! asset($media->url) !!}" width="80px">
                                    </a>
                                </td>
                                <td>Otto</td>
                                <td>{{ $media->directory->name }}</td>
                                <td>{{ $media->created_at->format("F j, Y") }}</td>
                            </tr>
                            <!-- Media Modal -->
                            <div class="modal fade modal{{ $media->id }}" tabindex="-1" role="dialog" aria-labelledby="mediaModal" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="exampleModalCenterTitle">Attachment Details</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modeal-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-8 text-center p-3 col-12">
                                                        <div class="row justify-content-center">
                                                            <div class="col-md-8 py-4">
                                                                <img src="{!! asset($media->url) !!}" alt="{!! asset($media->url) !!}" width="100%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12 p-3 bg-secondary">
                                                        <div class="file-info mb-4">
                                                            <small>
                                                                <strong>File name:</strong> {{ $media->name }}<br />
                                                                <strong>File type:</strong> {{ $media->mime_type }}<br />
                                                                <strong>Uploaded on:</strong> {{ $media->created_at->format("F j, Y") }}<br />
                                                                <strong>File size:</strong> {{ $media->size }} KB<br />
                                                                <strong>Dimensions:</strong> {{ $media->dimensions }}<br />
                                                                <strong>Directory:</strong> {{ $media->directory->name }}
                                                            </small>
                                                        </div>
                                                        <div class="file-actions">
                                                            <small>
                                                                <a href="{!! url(asset($media->url)) !!}">View Attachment Page</a><br />
                                                                <a href="#" class="text-danger" data-toggle="modal" data-target="#deleteConfirm{{ $media->id }}">Delete Permanently</a>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <th>No media files found.</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            @forelse ($medias as $media)
                <div class="col-md-2">
                    <a href="#" data-toggle="modal" data-target=".modal{{ $media->id }}">
                        <div class="card">
                            <img class="card-img" src="{!! asset($media->url) !!}" alt="{!! asset($media->url) !!}">
                        </div>
                    </a>
                </div>
                <!-- Media Modal -->
                <div class="modal fade modal{{ $media->id }}" tabindex="-1" role="dialog" aria-labelledby="mediaModal" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="exampleModalCenterTitle">Attachment Details</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modeal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-8 text-center p-3 col-12">
                                            <div class="row justify-content-center">
                                                <div class="col-md-8 py-4">
                                                    <img src="{!! asset($media->url) !!}" alt="{!! asset($media->url) !!}" width="100%">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12 p-3 bg-secondary">
                                            <div class="file-info mb-4">
                                                <small>
                                                    <strong>File name:</strong> {{ $media->name }}<br />
                                                    <strong>File type:</strong> {{ $media->mime_type }}<br />
                                                    <strong>Uploaded on:</strong> {{ $media->created_at->format("F j, Y") }}<br />
                                                    <strong>File size:</strong> {{ $media->size }} KB<br />
                                                    <strong>Dimensions:</strong> {{ $media->dimensions }}<br />
                                                    <strong>Directory:</strong> {{ $media->directory->name }}
                                                </small>
                                            </div>
                                            <div class="file-actions">
                                                <small>
                                                    <a href="{!! url(asset($media->url)) !!}">View Attachment Page</a><br />
                                                    <a href="#" class="text-danger" data-toggle="modal" data-target="#deleteConfirm{{ $media->id }}">Delete Permanently</a>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    No media files found.
                </div>
            @endforelse
        @endif

    </div>
@endsection
