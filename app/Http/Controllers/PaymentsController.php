<?php

namespace Urban\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Urban\Http\Requests\CheckoutRequest;
use Urban\Order;
use Urban\Product;
use Urban\OrderProduct;
use Urban\Mail\OrderConfirmed;
use Illuminate\Support\Facades\Mail;
use Darryldecode\Cart\Cart;

class PaymentsController extends Controller {

    public function getProduct($id) {
        return Product::find($id);
    }

    public function store(CheckoutRequest $request) {

        $contents = Cart::getContent()->map(function($item) {
            return $this->getProduct($item->p_id)->slug . ', ' . $item->quantity;
        })->values()->toJson();

        try {
            $charge = Stripe::charges()->create([
                'amount' => Cart::getTotal(),
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => Auth::user()->email,
                'metadata' => [
                    // Change to order ID after we start using DB
                    'contents' => $contents,
                    'quantity' => Cart::getTotalQuantity(),
                ],
            ]);

            // Insert into Orders table
            $order = $this->addToOrdersTables($request, Auth::user(), null);
            // Send order confirmation email
            Mail::send(new OrderConfirmed($order));

            // Successful
            Cart::clear();
            return redirect(route('thankyou', ['confirmed' => 1]))->with([
                'success' => 'Thank you! Your payment has been processed.'
            ]);
        } catch (CardErrorException $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }

    }

    public function addToOrdersTables($order, $user, $message) {
        // Insert into orders table
        $order = Order::create([
            'user_id' => $user->id,
            'order_no' => str_random(4),
            'bill_email' => $user->email,
            'bill_name' => $request->first_name . ' ' . $request->last_name,
            'bill_phone' => $userb->phone,
            'bill_address1'=> $userb->address1,
            'bill_address2' => $userb->address2,
            'bill_town_city' => $userb->town_city,
            'bill_province_state' => $userb->province_state,
            'bill_country' => $userb->country,
            'bill_postcode' => $userb->postcode,
            'bill_name_on_card' => $request->name_on_card,
            'bill_subtotal' => $this->getNumbers()->get('newSubtotal'),
            'bill_tax' => $this->getNumbers()->get('newTax'),
            'bill_total' => $this->getNumbers()->get('newTotal'),
            'error' => $error,
        ]);

        // Insert into order_product table
        foreach (Cart::getContent() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->p_id,
                'quantity' => $item->quantity,
            ]);
        }

        return $order;
    }
}
