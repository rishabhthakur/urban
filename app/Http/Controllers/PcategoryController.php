<?php

namespace Urban\Http\Controllers;

use Urban\Pcategory;
use Urban\Activity;
use Illuminate\Http\Request;

class PcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.posts.categories.index')->with([
            'array' => Pcategory::orderBy('created_at')->get(),
            'array_type' => 'Categories',
            'route' => route('admin.posts.categories.store')
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
            'name' => 'required|string'
        ]);

        $existing = Pcategory::where('name', $request->name)->first();

        if($existing) {
            return redirect(route('admin.posts.categories'))->with([
              'error' => 'A term with the name provided already exists.'
            ]);
       }

        $category = new Pcategory;

        $category->name = $request->name;

        if(isset($request->slug)) {
            $category->slug = $request->slug;
        } else {
            $category->slug = str_slug($request->name);
        }

        if(isset($parent_slug)) {
            $category->slug = $category->slug . '-' . $parent_slug;
        }

        if(isset($request->description)) {
            $category->description = $request->description;
        } else {
            $category->description = '–––';
        }

        if (isset($request->parent)) {
            $category->parent_id = $request->parent;
        }

        $category->save();

        // Log event
        $activity = new Activity;
        $model = 'Post\Category';
        $task = 'created new post category ' . $request->name;
        $activity->registerActivity($model, $task);

        return redirect()->route('admin.posts.categories');
    }

    public function vue_store(Request $request) {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $category = new Pcategory;
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->save();

        return response()->json([
            'message' => 'OK'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Urban\Pcategory  $pcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Pcategory $pcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Urban\Pcategory  $pcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Pcategory $pcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Urban\Pcategory  $pcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pcategory $pcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Urban\Pcategory  $pcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pcategory $pcategory)
    {
        //
    }
}
