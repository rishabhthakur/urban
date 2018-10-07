@extends('layouts.admin.app')

@section('content')
    @include('admin.users.includes.profile-header')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="heading mb-3">Activity Log</h6>
                    <ul class="timeline">
                        @forelse ($user->activities as $activity)
                            @include('admin.includes.activity')
                        @empty
                            No recent activity
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
