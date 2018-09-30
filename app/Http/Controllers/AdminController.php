<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Settings;
use App\Product;
use App\Scategory;
use App\Stag;
use App\Brand;
use App\Attribute;
use App\User;
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
            'settings' => new Settings
        ]);
    }
}
