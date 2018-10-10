<?php

namespace Urban\Http\Controllers;

use Urban\User;
use Urban\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {
    public $user;

    public function __construct() {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('auth.account.index')->with([
            'user' => $this->user
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function details() {
        return view('auth.account.details')->with([
            'user' => $this->user
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        $user = User::find($id);
        $user->profile->first_name = $request->first_name;
        $user->profile->last_name = $request->last_name;
        $user->email = $request->email;
        $user->profile->phone = $request->phone;
        $user->profile->company = $request->company;
        $user->profile->save();

        return redirect(route('account.details'))->with([
            'success' => 'Account details updated.'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addresses() {
        return view('auth.account.addresses')->with([
            'bill' => $this->user->addresses->where('type', 'billing')->first(),
            'ship' => $this->user->addresses->where('type', 'shipping')->first()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function wishlist() {
        return view('auth.account.wishlist')->with([
            'wishlist' => app('wishlist')->session(Auth::id())->getContent()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Urban\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Urban\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Urban\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
