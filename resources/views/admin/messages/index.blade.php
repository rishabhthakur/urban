@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="row no-gutters">
                @if (count($messages) > 0)
                    <div class="col-4 bg-secondary">
                        <div class="nav flex-column bg-white" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach ($messages as $msg)
                                <a class="nav-link border-bottom" id="v-pills-{{ $msg->id }}-tab" data-toggle="pill" href="#v-pills-{{ $msg->id }}" role="tab" aria-controls="v-pills-{{ $msg->id }}" aria-selected="true">
                                    <div class="p-2 clearfix">
                                        <span class="text-muted float-right">
                                            <small>{{ $msg->created_at->diffForHumans() }}</small>
                                        </span>
                                        <h6 class="mb-0 mt-1">
                                            <strong>{{ ucwords($msg->first_name) }}</strong>
                                        </h6>
                                        <div class="subject">
                                            {{ $msg->subject }}
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-8 border-left">
                        <div class="tab-content" id="v-pills-tabContent">
                            @foreach ($messages as $msg)
                                <div class="tab-pane fade" id="v-pills-{{ $msg->id }}" role="tabpanel" aria-labelledby="v-pills-{{ $msg->id }}-tab">
                                    <div class="list-group-item flex-column align-items-start border-0">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">
                                                <strong>{{ ucwords($msg->first_name . " " . $msg->last_name) }}</strong><br>
                                                <small>{{ $msg->email }}</small><br>
                                                <div class="subject mt-2">
                                                    {{ $msg->subject }}
                                                </div>
                                            </h6>
                                            <small>{{ $msg->created_at->format("F j, Y - g:i a") }}</small>
                                        </div>
                                        <hr>
                                        <div class="mb-1">
                                            {!!  $msg->message !!}
                                        </div>
                                        <ul class="nav justify-content-end mt-3">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">
                                                    <i class="fas fa-reply"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="card-body">
                        No messages found.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
