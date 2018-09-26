<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings;

class MaintenanceViewController extends Controller {

    /**
 	 * Block comment
 	 *
 	 * @param type
 	 * @return void
	 */
	public function index() {
        if(!Settings::first()->status) {
            return view('errors.503');
        } else {
            return redirect(route('home'));
        }
    }
}
