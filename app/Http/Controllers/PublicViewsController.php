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
}
