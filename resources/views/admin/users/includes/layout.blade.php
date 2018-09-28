@extends('layouts.admin.app')

@section('content')
<div class="row mb-4">
    <div class="col-12 text-right">
        <a href="{!! route('admin.users.create') !!}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card table-responsive">
            <table class="table rounded bg-white">

            </table>
        </div>
    </div>
</div>
@endsection
