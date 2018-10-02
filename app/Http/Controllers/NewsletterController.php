<?php

namespace Urban\Http\Controllers;

use Urban\User;
use Urban\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsletterController extends Controller {
    private $newsletter;

    public function __construct() {
        $this->newsletter = new Newsletter;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.newsletter.index')->with([
            'subscribers' => $this->newsletter->orderBy('created_at', 'DESC')
                                              ->get()
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
    public function store(Request $request) {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        if($this->newsletter->where('email', $request->email)->first()) {
            return back()->with([
                'info' => 'You have already subscribed to our newsletter.'
            ]);
        } else {
            $email = $request->email;
            if(Auth::check()) {
                if($this->newsletter->where('user_id', Auth::id())->first()) {
                    return back()->with([
                        'info' => 'You have already subscribed to our newsletter.'
                    ]);
                }
                $user_id = Auth::id();
                $user = User::find(Auth::id());
                $user->subscription = 1;
                $user->save();
            }
        }

        $this->newsletter->create([
            'user_id' => $user_id,
            'email' => $email
        ]);

        return back()->with([
            'success'=> 'Thank you for subscribing.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Urban\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(Newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Urban\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Urban\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Urban\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsletter $newsletter)
    {
        //
    }
}
