<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicViewsController extends Controller {

    public function __construct() {
        $this->middleware('maintenance');
    }

    public function index() {
        return view('errors.503');
        // return view('welcome');
    }

    public function about() {
        return view('about');
    }

    public function blog() {
        return view('blog');
    }

    public function contact() {
        return view('contact');
    }

    public function privacy() {
        return view('privacy');
    }

    public function terms() {
        return view('terms');
    }

    public function cart() {
        return view('cart');
    }

    public function checkout() {
        if (Auth::check()) {
            if (!count(Cart::getContent()) < 0) {
                return view('checkout');
            } else {
                return back()->with([
                    'error' => 'Your cart is empty'
                ]);
            }
        } else {
            redirect(route('login'));
        }
    }
}
