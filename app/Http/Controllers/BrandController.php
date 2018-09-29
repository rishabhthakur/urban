<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Activity;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.products.brands.index')->with([
            'array' => Brand::orderBy('created_at')->get(),
            'parent' => false,
            'color' => false,
            'array_type' => 'Brand',
            'route' => route('admin.products.brands.store')
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

        $existing = Brand::where('name', $request->name)->first();

        if($existing) {
            return redirect(route('admin.products.brands'))->with([
              'error' => 'A term with the name provided already exists.'
            ]);
        }

        $brand = new Brand;

        $brand->name = $request->name;

        if(isset($request->slug)) {
            $brand->slug = $request->slug;
        } else {
            $brand->slug = str_slug($request->name);
        }

        if(isset($request->description)) {
            $brand->description = $request->description;
        } else {
            $brand->description = '–––';
        }

        $brand->save();

        // Log event
        $activity = new Activity;
        $model = 'Product\Brand';
        $task = 'created new product brand ' . $request->name;
        $activity->registerActivity($model, $task);

        return redirect()->route('admin.products.brands');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
