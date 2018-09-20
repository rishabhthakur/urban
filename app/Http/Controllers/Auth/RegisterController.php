<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use App\Settings;
use App\Http\Controllers\Controller;
use App\Notifications\NewUserRegistration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
     * @return \App\User
     */
    protected function create(array $data) {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'slug' => str_slug($data['name']),
            'role_id' => $settings->drole
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
          'first_name' => $request->first_name,
          'last_name' => $request->last_name,
          'phone' => $request->phone,
          'avatar' => 'uploads/avatar/' .strtolower($data['name']). '/user.jpg'
        ]);

        User::find(1)->notify(new \App\Notifications\NewUserRegistration($user));

        // Return results
        return $user;
    }
}
