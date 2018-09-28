<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\Profile;

class UsersController extends Controller {

    private $user;

    public function __construct() {
        $this->users = new User;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.users.index')->with([
            'users' => $this->users->orderBy('created_at')->get()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customers() {
        return view('admin.users.customers')->with([
            'users' => $this->users->where('role_id', 4)
                                   ->orderBy('created_at')
                                   ->get()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function staff() {
        return view('admin.users.staff')->with([
            'users' => $this->users->where('role_id', 1)
                                   ->where('role_id', 2)
                                   ->where('role_id', 3)
                                   ->orderBy('created_at')
                                   ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.users.create')->with([
            'roles' => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required'
        ]);

        $user = $this->users->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'slug' => str_slug($request->name),
            'role_id' => $request->role
        ]);

        // Will copy foo/test.php to bar/test.php
        // overwritting it if necessary
        if (!is_dir(public_path('uploads/avatar/'.strtolower($request->name)))) {
            mkdir(public_path('uploads/avatar/'.strtolower($request->name)));
        }
        $strg = storage_path('app/public/avatars/user.jpg');
        $publc = public_path('uploads/avatar/' .strtolower($request->name). '/user.jpg');
        copy($strg, $publc);

        // Create profile for user
        Profile::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'job' => $request->job,
            'location' => $request->location,
            'avatar' => 'uploads/avatar/' .strtolower($request->name). '/user.jpg'
        ]);

        return back()->with([
            'success' => 'New user created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function profile($slug) {
        return view('admin.users.profile')->with([
            'user' => $this->users->where('slug', $slug)->first()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function activities($slug) {
        if (Auth::user()->role_id === 1) {
            return view('admin.users.activity')->with([
                'user' => $this->users->where('slug', $slug)->first()
            ]);
        } else {
            return redirect(route('admin'))->with([
                'error' => 'You do not have the required permission.'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        return view('admin.users.edit')->with([
            'user' => $this->users->where('slug', $slug)->first(),
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
