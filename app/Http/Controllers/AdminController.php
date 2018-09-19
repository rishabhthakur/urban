<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.index');
    }
}
