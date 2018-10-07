<?php

namespace Urban\Http\Controllers;

use Urban\User;
use Urban\Message;

use Urban\Mail\ReplyToMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller {

    protected $messages;

    public function __construct() {
        $this->messages = new Message;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        Auth::user()->unreadNotifications->where('type', 'Urban\Notifications\NewMessage')->markAsRead();
        return view('admin.messages.index')->with([
            'messages' => $this->messages->orderBy('created_at', 'DESC')
                                         ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request) {
        $this->validate($request, [
            'message' => 'required'
        ]);
        
        // dd($request->all());
        Mail::to($request->user_email)->send(new ReplyToMessage($request->all()));

        return redirect(route('admin.messages'))->with([
            'success' => 'Message has been sent.'
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        if(Auth::check()) {
            $id = Auth::id();
        } else {
            $id = null;
        }

        $message = $this->messages->create([
            'user_id' => $id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        $user = ucwords($message->first_name);

        User::find(1)->notify(new \Urban\Notifications\NewMessage($user));

        return redirect(route('contact'))->with([
            'success' => 'Thanks for the message. We\'ll get back to you as soon as possible.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Urban\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Urban\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Urban\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Urban\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
