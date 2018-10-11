<?php

namespace Urban\Http\Controllers;

use Urban\Activity;
use Urban\Settings;
use Urban\Product;
use Urban\Category;
use Urban\Stag;
use Urban\Brand;
use Urban\Order;
use Urban\Attribute;
use Urban\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller {

    /**
 	 * Block comment
 	 *
 	 * @param type
 	 * @return void
	 */
    public function login() {
        return view('admin.auth.login');
    }

    /**
 	 * Block comment
 	 *
 	 * @param type
 	 * @return void
	 */
    public function index() {
        return view('admin.index')->with([
            'activities' => Activity::orderBy('created_at', 'DESC')->take(7)->get(),
            'products' => new Product,
            'users' => new User,
            'settings' => new Settings,
            'orders' => new Order
        ]);
    }

    /**
 	 * Block comment
 	 *
 	 * @param type
 	 * @return void
	 */
    public function notifications() {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
        return view('admin.notifications')->with([
            'nots' => $user->notifications
        ]);
    }
}
