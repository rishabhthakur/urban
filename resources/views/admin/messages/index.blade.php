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
                                                <a class="nav-link" href="#" data-toggle="modal" data-target="#replyModal">
                                                    <i class="fas fa-reply"></i>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header border-0 pb-0">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="details mb-5">
                                                    <h6>
                                                        <span class="text-muted">To: </span>
                                                        <strong>{{ ucwords($msg->first_name . " " . $msg->last_name) }}</strong>
                                                    </h6>
                                                    <h6>
                                                        <span class="text-muted">Subject: </span>
                                                        Re: {{ $msg->subject }}
                                                    </h6>
                                                </div>
                                                <form action="{!! route('admin.messages.send') !!}" method="post" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <textarea id="message" name="message" class="form-control"></textarea>
                                                    </div>
                                                    <input type="hidden" name="user_email" value="{{ $msg->email }}">
                                                    <input type="hidden" name="user_name" value="{{ $msg->first_name }}">
                                                    <input type="hidden" name="subject" value="{{ $msg->subject }}">
                                                    <input type="hidden" name="meesage_id" value="{{ $msg->id }}">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Send</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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

@section('new-message-js')
    <script>
        tinymce.init({
            selector: '#message',
            themes: "modern",
            menubar: false,
            mobile: {
                theme: 'mobile',
                plugins: [ 'autosave', 'lists', 'autolink' ]
            }
        });
    </script>
@endsection
