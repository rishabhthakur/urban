<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::check()) {
            if(Auth::user()->role_id >= 3) {
                return redirect(route('home'))->with('error', 'You do not have the required permission.');
            }
        } else {
            return redirect(route('admin.login'));
        }
        return $next($request);
    }
}
