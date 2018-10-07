<li class="pb-3">
    <div class="mb-1">
        <span class="badge badge-primary">
            {{ $activity->created_at->format("F j, Y - g:i a") }}
        </span>
    </div>
    @switch($activity->model)
        @case('Urban\Product')
            <strong class="text-primary">New product added.</strong>
            @break
        @case('Urban\Media')
            <strong class="text-primary">New media item added.</strong>
            @break
        @case('Urban\Post')
            <strong class="text-primary">New post added.</strong>
            @break
    @endswitch
    <div class="mb-2">
        <a href="{!! route('admin.users.profile', ['slug' => $activity->user->slug]) !!}">
            <strong>{{ $activity->user->name }}</strong>
        </a> {{ $activity->task }} <strong>{{ $activity->item }}</strong>
    </div>
</li>
