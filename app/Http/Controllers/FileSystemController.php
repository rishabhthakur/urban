<?php

namespace Urban\Http\Controllers;

use Urban\FileSystem;
use Illuminate\Http\Request;

class FileSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
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
            'name' => 'required'
        ]);

        // Check & Make Directory
        if (!is_dir(public_path('uploads/' . str_slug($request->name)))) {
            mkdir(public_path('uploads/' . str_slug($request->name)));
        } else {
            return back()->with('error', 'Directory with the same name already exitsts.');
        }


        // Enter Directory Data into Database
        FileSystem::create([
            'name' => str_slug($request->name),
            'url'  => asset('uploads/' . str_slug($request->name)),
            'slug' => asset('uploads/' . str_slug($request->name)),
            'path' => public_path('uploads/' . str_slug($request->name))
        ]);

        return back()->with('success', 'Directory created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Urban\FileSystem  $fileSystem
     * @return \Illuminate\Http\Response
     */
    public function show(FileSystem $fileSystem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Urban\FileSystem  $fileSystem
     * @return \Illuminate\Http\Response
     */
    public function edit(FileSystem $fileSystem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Urban\FileSystem  $fileSystem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileSystem $fileSystem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Urban\FileSystem  $fileSystem
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileSystem $fileSystem)
    {
        //
    }
}
