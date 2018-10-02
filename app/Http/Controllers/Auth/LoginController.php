<?php

namespace Urban\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Urban\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm() {
        session()->put('previousUrl', url()->previous());
        return view('auth.login');
    }

    /**
     * Redirects to previous URL after login.
     * @return string $url
     */
    public function redirectTo() {
        // dd(session()->get('previousUrl'));
        if(session()->has('previousUrl')) {
            $this->redirectTo =  str_replace(url('/'), '', session()->get('previousUrl'));
        }
        return $this->redirectTo ?? '/';
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user) {
        if(isset($request->admin)) {
            if($user->role_id <= 3) {
                return redirect(route('admin'));
            }
        }
    }
}
