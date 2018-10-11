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

use Cart;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

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
                'receipt_email' => $request->email,
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
            // Notify admin of purchase
            User::where('admin', 1)->first()->notify(new \Urban\Notifications\NewOrder($order));

            // Successful
            Cart::clear();
            return redirect(route('thankyou', ['confirmed' => 1]))->with([
                'success' => 'Thank you! Your payment has been processed.'
            ]);
        } catch (CardErrorException $e) {
            return back()->with([
                'error' => $e->getMessage()
            ]);
        }

    }

    public function addToOrdersTables($request, $user, $message) {
        // Insert into orders table
        $order = Order::create([
            'user_id' => $user->id,
            'order_no' => str_random(4),
            'bill_email' => $user->email,
            'bill_name' => $request->first_name . ' ' . $request->last_name,
            'bill_phone' => $request->phone,
            'bill_address1'=> $request->address1,
            'bill_address2' => $request->address2,
            'bill_town_city' => $request->city,
            'bill_province_state' => $request->state,
            'bill_country' => $request->country,
            'bill_postcode' => $request->postcode,
            'bill_name_on_card' => $request->name_on_card,
            'bill_subtotal' => getNumbers()->get('newSubtotal'),
            'bill_tax' => getNumbers()->get('newTax'),
            'bill_total' => getNumbers()->get('newTotal'),
            'error' => $message,
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
