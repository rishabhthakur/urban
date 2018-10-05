<?php

namespace Urban\Http\Controllers;

use Urban\Post;
use Urban\User;
use Urban\Tag;
use Urban\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Urban\Activity;
use Urban\Settings;
use Urban\Media;
use Urban\Dsettings;
use Urban\FileSystem;

class PostController extends Controller {

    private $settings;

    public function __construct() {
        $this->settings = Settings::first();
    }
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
            'medias' => Media::where('dir_id', Settings::first()->post_dir)->get(),
            'users' => User::all(),
            'dsettings' => Dsettings::first(),
            'edit' => false
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
            $media = $request->image;
            $dir = FileSystem::find($this->settings->post_dir);

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

        if (isset($request->status)) {
            $status = 1;
        } else {
            $status = 0;
        }

        if (isset($request->visibility)) {
            $visibility = 1;
        } else {
            $visibility = 0;
        }

        if (isset($request->discussion)) {
            $discussion = 1;
        } else {
            $discussion = 0;
        }

        if (isset($request->excerpt)) {
            $excerpt = $request->excerpt;
        } else {
            $excerpt = strip_tags(str_limit($request->content, $limit = 100));
        }

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'slug' => str_slug($request->title),
            'excerpt' => $excerpt,
            'status' => $status,
            'visibility' => $visibility,
            'media_id' => $media_id,
            'discussion' => $discussion
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
    public function edit($id) {
        return view('admin.posts.edit')->with([
            'post' => Post::find($id),
            'dsettings' => Dsettings::first(),
            'users' => User::all(),
            'medias' => Media::where('dir_id', Settings::first()->post_dir)->get(),
            'edit' => true
        ]);
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
