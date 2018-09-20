<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicViewsController extends Controller {

    public function __construct() {
        $this->middleware('maintenance');
    }

    public function index() {
        return view('welcome');
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
}
