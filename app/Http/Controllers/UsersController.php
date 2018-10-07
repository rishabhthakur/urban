<?php

namespace Urban\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Urban\User;
use Urban\Role;
use Urban\Profile;

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
        $col = $this->users->latest();

        switch (request()->sort) {
            case 'customers':
                $list = $col->where('role_id', 4)->get();
                break;
            case 'editors':
                $list = $col->where('role_id', 3)->get();
                break;
            case 'moderators':
                $list = $col->where('role_id', 2)->get();
                break;
            case 'administrators':
                $list = $col->where('role_id', 1)->get();
                break;
            default:
                $list = $col->get();
                break;
        }

        return view('admin.users.index')->with([
            'users' => $list
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
            'avatar' => 'user.jpg'
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

    public function update_account(Request $request, $slug) {
        $user = User::where('slug', $slug)->first();
        // User account
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->save();

        return back()->with([
            'success' => 'Profile updated.'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug) {
        $this->validate($request, [
            'avatar' => 'image|mimes:jpeg,jpg,png'
        ]);

        $user = User::where('slug', $slug)->first();

        if($request->hasFile('avatar')) {
            // Set filename to var avatar
            $avatar = $request->avatar;
            // Generate new name for avatar file
            $avatar_new_name = time().$avatar->getClientOriginalName();
            // Move file to to uploads/avatar/username folder
            $avatar->move(public_path('uploads/avatar/' . strtolower($user->name)), $avatar_new_name);
            // Register avatar name to user profile database
            $user->profile->avatar = $avatar_new_name;
        }

        // User profile
        $user->profile->first_name = $request->first_name;
        $user->profile->last_name = $request->last_name;
        $user->profile->job = $request->job;
        $user->profile->location = $request->location;
        $user->profile->bio = $request->bio;
        $user->profile->save();

        return back()->with([
            'success' => 'Profile updated.'
        ]);
    }

    public function saveAvatar($avatar) {
        // code...
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
