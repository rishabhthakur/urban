<li>
    @switch($activity->model)
        @case('Product\Product')
            <strong class="text-primary">New product added.</strong>
            @break
        @case('Product\Category')
            <strong class="text-primary">New product category added.</strong>
            @break
        @case('Product\Tag')
            <strong class="text-primary">New product tag added.</strong>
            @break
        @case('Product\Attribute')
            <strong class="text-primary">New product attribute added.</strong>
            @break
        @case('Product\Brand')
            <strong class="text-primary">New product brand added.</strong>
            @break
        @case('Media\Media')
            <strong class="text-primary">New media item added.</strong>
            @break
        @case('User\Login')
            <strong class="text-primary">User loggin.</strong>
            @break
    @endswitch
    <span class="float-right badge badge-primary">
        {{ $activity->created_at->format("F j, Y") }}
    </span>
    <p>
        <a href="#"><strong>{{ $activity->user->name }}</strong></a> {{ $activity->task }}
    </p>
</li>
