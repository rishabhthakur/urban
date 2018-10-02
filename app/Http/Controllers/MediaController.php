<?php

namespace Urban\Http\Controllers;

use Urban\Media;
use Urban\FileSystem;
use Urban\Activity;
use Urban\MediaProduct;
use Urban\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // dd(request()->all);
        return view('admin.media.index')->with([
            'medias' => Media::all(),
            'dirs' => FileSystem::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.media.create')->with([
            'medias' => Media::all(),
            'dirs' => FileSystem::all()
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
            'file' => 'required|image|max:3000',
            'dir' => 'required'
        ]);

        $files = $request->file('file');

        if(!is_array($files)) {
            $files = [$files];
        }

        $dir = FileSystem::find($request->dir);

        for ($i = 0; $i < count($files); $i++) {
            // Product Image Re-location and Re-naming
            $media = $files[$i];
            $media_new_name = time().$media->getClientOriginalName();
            $media->move('uploads/'. $dir->name, $media_new_name);
            $murl = 'uploads/'. $dir->name . '/' . $media_new_name;
            $mpath = public_path('uploads/'. $dir->name) . '/' . $media_new_name;


            // Enter Media Data to Database
            $prmedia = Media::create([
                'name' => $media_new_name,
                'slug' => $murl,
                'url' => $murl,
                'size' => number_format(filesize($mpath) * .0009765625),
                'mime_type' => $media->getClientMimeType(),
                'dimensions' => getimagesize($murl)[0] . ' x ' . getimagesize($murl)[1],
                'dir_id' => $dir->id,
                'user_id' => Auth::id()
            ]);
        }

        Activity::create([
            'user_id' => Auth::id(),
            'model' => 'Media\Media',
            'task' => 'added new media ' . $prmedia->name
        ]);

        return Response::json([
            'message' => 'Files uploaded.'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Urban\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Urban\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Urban\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Urban\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }
}
