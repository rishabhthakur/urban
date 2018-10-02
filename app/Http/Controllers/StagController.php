<?php

namespace Urban\Http\Controllers;

use Urban\Stag;
use Urban\Activity;
use Illuminate\Http\Request;

class StagController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.products.tags.index')->with([
            'array' => Stag::orderBy('created_at')->get(),
            'parent' => false,
            'color' => false,
            'array_type' => 'Tags',
            'route' => route('admin.products.tags.store')
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

        $existing = Stag::where('name', $request->name)->first();

        if($existing) {
            return redirect(route('admin.products.tags'))->with([
              'error' => 'A term with the name provided already exists.'
            ]);
        }

        $brand = new Stag;

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
        $model = 'Product\Tag';
        $task = 'created new product tag ' . $request->name;
        $activity->registerActivity($model, $task);

        return redirect()->route('admin.products.tags');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function vue_store(Request $request) {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $existing = Stag::where('name', $request->name)->first();

        if($existing) {
            return response()->json([
                'message' => 'A term with the name provided already exists.'
            ], 422);
        }

        $tag = new Stag;
        $tag->name = $request->name;
        $tag->slug = str_slug($request->name);
        $tag->description = '–––';
        $tag->save();

        return response()->json([
            'message' => 'OK'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Urban\Stag  $stag
     * @return \Illuminate\Http\Response
     */
    public function show(Stag $stag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Urban\Stag  $stag
     * @return \Illuminate\Http\Response
     */
    public function edit(Stag $stag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Urban\Stag  $stag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stag $stag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Urban\Stag  $stag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stag $stag)
    {
        //
    }
}
