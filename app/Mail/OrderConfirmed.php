<?php

namespace Urban\Mail;

use Urban\Order;
use Urban\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order) {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->order->bill_email, $this->order->bill_name)
                    // ->bcc('another@another.com')
                    ->subject('Order for ' . Settings::first()->site_name)
                    ->markdown('emails.orders.confirmed');
    }
}
