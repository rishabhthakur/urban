@component('mail::message')
# Order Received

Thank you for your order.

**Order ID:** {{ $order->id }}

**Order Email:** {{ $order->bill_email }}

**Order Name:** {{ $order->bill_name }}

**Order Total:** ${{ round($order->bill_total / 100, 2) }}

**Items Ordered**

@foreach ($order->products as $product)
Name: {{ $product->name }} <br>
Price: ${{ round($product->price / 100, 2)}} <br>
Quantity: {{ $product->pivot->quantity }} <br>
@endforeach

You can get further details about your order by logging into our website.

@component('mail::button', ['url' => config('app.url')])
Go to Website
@endcomponent

Thank you again for choosing us.

Regards,<br>
{{ config('app.name') }}
@endcomponent
