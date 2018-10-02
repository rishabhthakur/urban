<?php

namespace Urban\Http\Controllers;

use Urban\Scategory;
use Urban\Activity;
use Illuminate\Http\Request;

class ScategoryController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.products.categories.index')->with([
            'array' => Scategory::orderBy('created_at')->get(),
            'parent' => true,
            'color' => false,
            'array_type' => 'Categories',
            'route' => route('admin.products.categories.store')
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

        $existing = Scategory::where('name', $request->name)->first();

        if($existing) {
           if ($existing->parent_id == $request->parent) {
               return redirect(route('admin.products.categories'))->with([
                 'error' => 'A term with the name provided already exists.'
               ]);
           } else {
               $parent_slug = str_slug(Scategory::find($request->parent)->name);
           }
           $parent_slug = str_slug(Scategory::find($request->parent)->name);
       }

        $category = new Scategory;

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

        if (isset($request->image)) {
            // Category Image Re-location and Re-naming
            $image = $request->image;
            $image_new_name = time().$image->getClientOriginalName();
            $image->move('uploads', $image_new_name);
            $category->image = 'uploads/' . $image_new_name;
        }

        $category->save();

        // Log event
        $activity = new Activity;
        $model = 'Product\Category';
        $task = 'created new product category ' . $request->name;
        $activity->registerActivity($model, $task);

        return redirect()->route('admin.products.categories');
    }

    public function vue_store(Request $request) {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $existing = Scategory::where('name', $request->name)->first();

        if($existing) {
           if ($existing->parent_id == $request->parent) {
               return response()->json([
                   'message' => 'A term with the name provided already exists.'
               ], 422);
           } else {
               $parent_slug = str_slug(Scategory::find($request->parent)->name);
           }
           $parent_slug = str_slug(Scategory::find($request->parent)->name);
       }

        $category = new Scategory;
        $category->name = $request->name;
        if (isset($request->parent)) {
            $category->parent_id = $request->parent;
        }
        $category->slug = str_slug($request->name);

        $category->save();

        return response()->json([
            'message' => 'OK'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Urban\Scategory  $scategory
     * @return \Illuminate\Http\Response
     */
    public function show(Scategory $scategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Urban\Scategory  $scategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Scategory $scategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Urban\Scategory  $scategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scategory $scategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Urban\Scategory  $scategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scategory $scategory)
    {
        //
    }
}
