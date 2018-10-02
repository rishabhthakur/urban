<?php

namespace Urban\Http\Controllers;

use Urban\Post;
use Urban\Ptag;
use Urban\Pcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Urban\Activity;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.posts.index')->with([
            'posts' => Post::orderBy('created_at', 'DESC')->get(),
            'pcategories' => Pcategory::all(),
            'ptags' => Ptag::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.posts.create')->with([
            'pcategories' => Pcategory::all(),
            'ptags' => Ptag::all()
        ]);
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
