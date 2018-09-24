<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Activity;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.attributes.index')->with([
            'array' => Attribute::orderBy('created_at')->get(),
            'parent' => true,
            'color' => true,
            'array_type' => 'Attribute',
            'route' => 'admin.products.attributes.store'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
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

        $existing = Attribute::where('name', $request->name)->first();

        if($existing) {
           if ($existing->parent_id == $request->parent) {
               return redirect(route('admin.products.attributes'))->with([
                 'error' => 'A term with the name provided already exists.'
               ]);
           }
        }

        $attribute = new Attribute;

        $attribute->name = $request->name;

        if(isset($request->slug)) {
            $attribute->slug = $request->slug;
        } else {
            $attribute->slug = str_slug($request->name);
        }

        if(isset($request->description)) {
            $attribute->description = $request->description;
        } else {
            $attribute->description = '–––';
        }

        if(isset($request->color_code)) {
            $attribute->color_code = $request->color_code;
        } else {
            $attribute->color_code = null;
        }

        if (isset($request->parent)) {
            $attribute->parent_id = $request->parent;
        }

        $attribute->save();

        // Log event
        $activity = new Activity;
        $model = 'Product\Attribute';
        $task = 'created new product attribute ' . $request->name;
        $activity->registerActivity($model, $task);

        return redirect()->route('admin.products.attributes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        //
    }
}
