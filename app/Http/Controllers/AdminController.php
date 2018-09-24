<?php

namespace App\Http\Controllers;

use App\Activity;
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
            'activities' => Activity::orderBy('created_at')->take(7)->get()
        ]);
    }
}
