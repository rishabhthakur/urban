<?php

namespace App\Http\Middleware;

use Closure;
use App\Settings;

class Maintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        /**
         * Gets mode from Settings table.
         * if boolean is true works normally.
    	 * else redirects to maintenance mode page.
    	 *
    	 * @param type boolean
    	 * @return void
         */
        $mode = Settings::first()->status;

        if($mode) {
            return $next($request);
        } else {
            return redirect(route('errors.503'));
        }
    }
}
