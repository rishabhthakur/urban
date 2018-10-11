@forelse (getNotifications() as $not)
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
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
    </a>
@empty
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <small>No notifications found.</small>
    </a>
@endforelse
