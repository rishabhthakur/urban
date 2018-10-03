<?php

namespace Urban\Http\Controllers;

use Urban\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        if ($request->from == 'product') {
            $belongs_to = 'product';
        } elseif ($request->from == 'post') {
            $belongs_to = 'post';
        }

        return view('admin.tags.index')->with([
            'array' => Tag::where('belongs_to', $belongs_to)->orderBy('created_at')->get(),
            'parent' => false,
            'color' => false,
            'array_type' => 'Tags',
            'route' => route('admin.tags.store')
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

        $tag = new Stag;

        $tag->name = $request->name;

        if(isset($request->slug)) {
            $tag->slug = $request->slug;
        } else {
            $tag->slug = str_slug($request->name);
        }

        if(isset($request->description)) {
            $tag->description = $request->description;
        } else {
            $tag->description = '–––';
        }

        $tag->belongs_to = $belongs_to;

        $tag->save();

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
        $tag->belongs_to = $request->belongs_to;
        $tag->save();

        return response()->json([
            'message' => 'OK'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Urban\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Urban\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Urban\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Urban\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
