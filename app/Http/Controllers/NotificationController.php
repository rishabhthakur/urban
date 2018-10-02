<?php

namespace Urban\Http\Controllers;

use Illuminate\Http\Request;
use Urban\User;
use Urban\Notifications\NewUserRegistration;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        // 
    }
}
