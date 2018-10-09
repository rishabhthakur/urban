@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h6 class="heading mb-0">Add New Attribute</h6>
                <div class="mb-5">
                    <small>Attributes let you define extra product data, such as size or color. You can use these attributes in the shop sidebar using the "layered nav" widgets.</small>
                </div>
                <form action="{!! route('admin.products.attributes.store') !!}" method="post">
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
                            <small>Name for the attribute (shown on the front-end).</small>
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
                            <small>Unique slug/reference for the attribute; must be no more than 28 characters.</small>
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
                            <a href="{!! route('admin.products.attributes.data', ['id' => $element->id]) !!}">
                                <span>
                                    <strong>{{ $element->name }}</strong>
                                </span>
                            </a>
                            <br />
                            <span>
                                <small>
                                    <strong>Slug:</strong> {{ $element->slug }}
                                </small>
                            </span>
                        </div>
                        <div class="col">
                            <ul class="categorylist">
                                @forelse ($element->data as $data)
                                    <li>{{ $data->name }}</li>
                                @empty
                                    <p>
                                        No terms found.
                                    </p>
                                @endforelse
                            </ul>
                        </div>
                        <div class="col-1 clearfix">
                            <div class="dropdown float-right">
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
                        No attributes found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
