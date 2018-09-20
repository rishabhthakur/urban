<?php

namespace App\Http\Controllers;

use App\Settings;
use App\Role;
use Illuminate\Http\Request;

class SettingsController extends Controller {

    public function __construct() {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.settings.index')->with([
            'settings' => Settings::first(),
            'roles' => Role::all()
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
            'site_name' => 'required',
            'tagline' => 'required',
            'description' => 'required',
            'author' => 'required',
            'email' => 'required|email',
        ]);

        if(isset($request->membership)) {
            $membership = 1;
        } else {
            $membership = 0;
        }

        $settings = Settings::first();
        $settings->site_name = $request->site_name;
        $settings->tagline = $request->tagline;
        $settings->description = $request->description;
        $settings->author = $request->author;
        $settings->email = $request->email;
        $settings->drole = $request->role;
        $settings->membership = $membership;
        $settings->save();

        return back()->with('success', 'Changes saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function store_status(Request $request) {
        $this->validate($request, [
            'copyright_text' => 'required'
        ]);

        $settings = Settings::first();

        if(isset($request->status)) {
            $status = 1;
        } else {
            $status = 0;
        }

        if(isset($request->privacy)) {
            $privacy = 1;
        } else {
            $privacy = 0;
        }

        if(isset($request->legal)) {
            $legal = 1;
        } else {
            $legal = 0;
        }

        if(isset($request->copyright)) {
            $copyright = 1;
        } else {
            $copyright = 0;
        }

        $settings->status = $status;
        $settings->privacy = $privacy;
        $settings->legal = $legal;
        $settings->copyright = $copyright;
        $settings->copyright_text = $request->copyright_text;
        $settings->save();

        return back()->with('success', 'Changes saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
