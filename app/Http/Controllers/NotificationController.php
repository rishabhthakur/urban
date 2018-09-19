<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\NewUserRegistration;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        // 
    }
}
