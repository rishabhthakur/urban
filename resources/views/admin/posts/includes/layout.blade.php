@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h6 class="heading mb-5">Add New {{ __($array_type) }}</h6>
                <form action="{{ $route }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="" placeholder="Name" required>
                        @if ($errors->has('name'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('name') }}</strong></small>
                            </span>
                        @endif
                        <span class="text-muted form-text">
                            <small>The name is how it appears on your site.</small>
                        </span>
                    </div>
                    <div class="form-group{{ $errors->has('slug') ? ' has-danger' : '' }}">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" value="" placeholder="Slug">
                        @if ($errors->has('slug'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('slug') }}</strong></small>
                            </span>
                        @endif
                        <span class="text-muted form-text">
                            <small>The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
                        </span>
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>
                        @if ($errors->has('description'))
                            <span class="text-danger form-text" role="alert">
                                <small><strong>{{ $errors->first('description') }}</strong></small>
                            </span>
                        @endif
                        <span class="text-muted form-text">
                            <small>The description is not prominent by default; however, some themes may show it.</small>
                        </span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create New</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                @forelse ($array as $element)
                    <div class="row">
                        <div class="col-4">
                            <span>
                                <strong>{{ $element->name }}</strong>
                            </span><br />
                            <span>
                                <small>
                                    <strong>Slug:</strong> {{ $element->slug }}
                                </small>
                            </span>
                        </div>
                        <div class="col-7">
                            <small>
                                {{ $element->description }}
                            </small>
                        </div>
                        <div class="col-1">
                            <div class="dropdown">
                                <a class="dropdown-toggle text-dark" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="far fa-trash-alt"></i>
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @empty
                    <div>
                        No {{ __($array_type) }} found.
                    </div>
                @endforelse
                @if ($array_type == 'Categories')
                    <p class="text-muted">
                        <small>
                            Deleting a category does not delete the posts in that category. Instead, posts that were only assigned to the deleted category are set to the category Uncategorized.
                        </small>
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
