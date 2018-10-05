<?php

namespace Urban\Http\Controllers;

use Urban\Settings;
use Urban\Dsettings;
use Urban\Role;
use Urban\FileSystem;
use Illuminate\Http\Request;

class SettingsController extends Controller {

    protected $settings;
    protected $dsettings;
    private $down;


    public function __construct() {
        $this->middleware('admin');
        $this->settings = Settings::first();
        $this->dsettings = Dsettings::first();
        $this->down = storage_path('framework/down');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.settings.index')->with([
            'settings' => $this->settings,
            'roles' => Role::all()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function discussion() {
        return view('admin.settings.discussion')->with([
            'settings' => $this->settings,
            'dsettings' => $this->dsettings
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function media() {
        return view('admin.settings.media')->with([
            'settings' => $this->settings,
            'dirs' => FileSystem::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Urban\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function media_store(Request $request) {

        $settings = $this->settings;
        $settings->product_dir = $request->product_dir;
        $settings->post_dir = $request->post_dir;
        $settings->save();

        return back()->with([
            'success' => 'Changes saved.'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy() {
        return view('admin.settings.privacy')->with([
            'settings' => $this->settings,
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

        $settings = $this->settings;
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
     * @param  \Urban\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function store_status(Request $request) {
        $this->validate($request, [
            'copyright_text' => 'required'
        ]);

        $settings = $this->settings;

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

        if(!$status) {
            touch($this->down);
            // return view('errors.503');
        } else {
            if(file_exists($this->down)) {
                unlink($this->down);
            }
        }

        return back()->with('success', 'Changes saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Urban\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function privacy_status(Request $request) {
        $settings = $this->settings;
        if(isset($request->privacy)) {
            $privacy = 1;
        } else {
            $privacy = 0;
        }
        $settings->privacy = $privacy;
        $settings->save();
        return back()->with('success', 'Changes saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Urban\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Urban\Settings  $settings
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
     * @param  \Urban\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Urban\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
