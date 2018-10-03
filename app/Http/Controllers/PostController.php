<?php

namespace Urban\Http\Controllers;

use Urban\Post;
use Urban\Tag;
use Urban\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Urban\Activity;
use Urban\Media;
use Urban\FileSystem;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.posts.index')->with([
            'posts' => Post::orderBy('created_at', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.posts.create')->with([
            'medias' => Media::all()
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
            'title' => 'required|string',
            'content' => 'required',
            'categories' => 'required',
            'tags' => 'required'
        ]);

        if (isset($request->image)) {
            $dir = FileSystem::where('name', 'posts')->first();

            // Product Image Re-location and Re-naming
            $media_new_name = time() . $media->getClientOriginalName();
            $media->move('uploads/' . $dir->name, $media_new_name);
            $murl = 'uploads/' . $dir->name . '/' . $media_new_name;
            $mpath = public_path('uploads/' . $dir->name) . '/' . $media_new_name;

            // Enter Media Data to Database
            $prmedia = Media::create([
                'name' => $media_new_name,
                'user_id' => Auth::id(),
                'dir_id' => $dir->id,
                'name' => $media_new_name,
                'slug' => $murl,
                'url' => $murl,
                'size' => number_format(filesize($mpath) * .0009765625),
                'mime_type' => $media->getClientMimeType(),
                'dimensions' => getimagesize($murl)[0] . ' x ' . getimagesize($murl)[1],
            ]);

            $media_id = $prmedia->id;

        } elseif (isset($request->media)) {
            $media_id = $request->media;
        }

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'status' => $status,
            'visibility' => $visibility,
            'media_id' => $media_id
        ]);

        // Product Tags, Categories and Attributes Register into Database
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $this->logActivity($post->title);

        return redirect(route('admin.posts'))->with([
            'success' => 'New post added.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Urban\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Urban\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Urban\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Urban\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Urban\Product  $product
     * @return \Illuminate\Http\Response
     */
    private function logActivity($post_name) {
        Activity::create([
            'user_id' => Auth::id(),
            'model' => 'PostModel',
            'task' => 'added new post ' . $post_name
        ]);
    }
}
