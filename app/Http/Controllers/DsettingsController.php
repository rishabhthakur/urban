<?php

namespace Urban\Http\Controllers;

use Urban\Dsettings;
use Illuminate\Http\Request;

class DsettingsController extends Controller {

    private $dsettings;

    public function __construct() {
        $this->dsettings = Dsettings::first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Urban\Dsettings  $dsettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {

        if (isset($request->discussion)) {
            $this->dsettings->discussion = 1;
        } else {
            $this->dsettings->discussion = 0;
        }

        if (isset($request->discussion_full)) {
            $this->dsettings->discussion_full = 1;
        } else {
            $this->dsettings->discussion_full = 0;
        }

        if (isset($request->discussion_auth)) {
            $this->dsettings->discussion_auth = 1;
        } else {
            $this->dsettings->discussion_auth = 0;
        }

        if (isset($request->auto_close_discussion)) {
            $this->dsettings->auto_close_discussion = 1;
        } else {
            $this->dsettings->auto_close_discussion = 0;
        }

        if (isset($request->discussion_email)) {
            $this->dsettings->discussion_email  = 1;
        } else {
            $this->dsettings->discussion_email  = 0;
        }

        if (isset($request->discussion_spam_email)) {
            $this->dsettings->discussion_spam_email = 1;
        } else {
            $this->dsettings->discussion_spam_email = 0;
        }

        if (isset($request->discussion_approve)) {
            $this->dsettings->discussion_approve = 1;
        } else {
            $this->dsettings->discussion_approve = 0;
        }

        if (isset($request->discussion_approve_once)) {
            $this->dsettings->discussion_approve_once = 1;
        } else {
            $this->dsettings->discussion_approve_once = 0;
        }

        $this->dsettings->save();

        return back()->with([
            'success' => 'Changes saved.'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Urban\Dsettings  $dsettings
     * @return \Illuminate\Http\Response
     */
    public function show(Dsettings $dsettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Urban\Dsettings  $dsettings
     * @return \Illuminate\Http\Response
     */
    public function edit(Dsettings $dsettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Urban\Dsettings  $dsettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dsettings $dsettings)
    {
        //
    }
}
