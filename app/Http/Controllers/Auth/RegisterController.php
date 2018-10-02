<?php

namespace Urban\Http\Controllers\Auth;

use Urban\User;
use Urban\Profile;
use Urban\Settings;
use Urban\Http\Controllers\Controller;
use Urban\Notifications\NewUserRegistration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/checkout';

    /**
     * Retrive default app settings.
     *
     * @var string
     */
    protected $settings;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
        $this->settings = Settings::first();
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm() {
        if($this->settings->membership) {
            return view('auth.register');
        } else {
            return redirect(route('login'));
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Urban\User
     */
    protected function create(array $data) {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'slug' => str_slug($data['name']),
            'role_id' => $this->settings->drole
        ]);

        // Will copy foo/test.php to bar/test.php
        // overwritting it if necessary
        if (!is_dir(public_path('uploads/avatar/'.strtolower($data['name'])))) {
          mkdir(public_path('uploads/avatar/'.strtolower($data['name'])));
        }
        $strg = storage_path('app/public/avatars/user.jpg');
        $publc = public_path('uploads/avatar/' .strtolower($data['name']). '/user.jpg');
        copy($strg, $publc);

        // Create profile for user
        Profile::create([
          'user_id' => $user->id,
          'first_name' => $data['first_name'],
          'last_name' => $data['last_name'],
          'phone' => $data['phone'],
          'avatar' => 'uploads/avatar/' .strtolower($data['name']). '/user.jpg'
        ]);

        User::find(1)->notify(new \Urban\Notifications\NewUserRegistration($user));

        // Return results
        return $user;
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user) {
        if(isset($request->fromAdmin)) {
            if($request->fromAdmin) {
                return redirect(route('admin.users.create'));
            }
        }
    }
}
