@extends('layouts.admin.app')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="heading mb-5">Notifications</h6>
                    <div id="notifications" class="list-group list-group-flush">
                        @forelse ($nots as $not)
                            <div class="list-group-item flex-column align-items-start
                            @if (!$not->read_at)
                                bg-secondary
                            @endif
                            ">
                                @switch($not->type)
                                    @case("Urban\Notifications\NewPostComment")
                                        <div>
                                            {{ $not->data['message'] }}
                                        </div>
                                        <span class="text-primary">
                                            <small>New comment.</small>
                                        </span>
                                        @break
                                    @case("Urban\Notifications\NewUserRegistration")
                                        <div>
                                            <strong>{{ $not->data['name'] }}</strong> {{ $not->data['message'] }}
                                        </div>
                                        <span class="text-primary">
                                            <small>New customer registration.</small>
                                        </span>
                                        @break
                                    @case("Urban\Notifications\NewMessage")
                                        <div>
                                            {{ $not->data['message'] }}
                                        </div>
                                        <span class="text-primary">
                                            <small>New message.</small>
                                        </span>
                                        @break
                                    @case("Urban\Notifications\NewOrder")
                                        <div>
                                            <strong>{{ $not->data['name'] }}</strong> {{ $not->data['message'] }}
                                        </div>
                                        <span class="text-primary">
                                            <small>New order placed.</small>
                                        </span>
                                        @break
                                    @default
                                        <span class="text-primary">
                                            <small>{{ $not->data['name'] }}</small>
                                        </span>
                                @endswitch
                                <div class="d-flex w-100 justify-content-between">
                                    <small>{{ $not->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @empty
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <small>No notifications found.</small>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('admin-notifications-js')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#timeline-card").mCustomScrollbar({
                theme: "minimal-dark"
            });
        });
    </script>
@endsection
