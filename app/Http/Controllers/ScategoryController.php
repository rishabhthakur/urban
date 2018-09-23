<?php

namespace App\Http\Controllers;

use App\Scategory;
use Illuminate\Http\Request;

class ScategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.products.categories.index')->with([
            'array' => Scategory::orderBy('created_at')->get(),
            'parent' => true,
            'array_type' => 'Categories',
            'route' => 'admin.products.categories.store'
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

        foreach(Scategory::all() as $c) {
            if($c->name == $request->name) {
                if($c->parent_id == $request->parent) {
                    return redirect(route('admin.products.categories'))->with([
                        'error' => 'A term with the name provided already exists.'
                    ]);
                }
                break;
            }
            break;
        }

        $category = new Scategory;

        $category->name = $request->name;

        if(isset($request->slug)) {
            $category->slug = $request->slug;
        } else {
            $category->slug = str_slug($request->name);
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

        return redirect()->route('admin.products.categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Scategory  $scategory
     * @return \Illuminate\Http\Response
     */
    public function show(Scategory $scategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Scategory  $scategory
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
     * @param  \App\Scategory  $scategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scategory $scategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Scategory  $scategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scategory $scategory)
    {
        //
    }
}
