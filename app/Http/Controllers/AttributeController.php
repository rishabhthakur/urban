<?php

namespace App\Http\Controllers;

use App\Adata;
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
            'array' => Attribute::orderBy('created_at')->get()
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
            'name' => 'required|string|min:2'
        ]);

        $existing = Attribute::where('name', $request->name)->first();
        if($existing) {
            return redirect(route('admin.products.attributes'))->with([
              'error' => 'A term with the name provided already exists.'
            ]);
        }

        $attribute = new Attribute;
        $attribute->name = $request->name;
        if(isset($request->slug)) {
            $attribute->slug = $request->slug;
        } else {
            $attribute->slug = str_slug($request->name);
        }
        $attribute->save();

        return redirect()->route('admin.products.attributes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data($id) {
        return view('admin.products.attributes.data')->with([
            'array' => Adata::where('attrb_id', $id)->orderBy('created_at', 'DESC')->get(),
            'parent' => false,
            'color' => true,
            'array_type' => Attribute::find($id)->name,
            'route' => route('admin.products.attributes.data.store', ['id' => $id])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function data_store(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $existing = Adata::where('name', $request->name)->first();

        if($existing) {
           if ($existing->parent_id == $request->parent) {
               return redirect(route('admin.products.attributes'))->with([
                 'error' => 'A term with the name provided already exists.'
               ]);
           }
        }

        $data = new Adata;

        $data->name = $request->name;

        if(isset($request->slug)) {
            $data->slug = $request->slug;
        } else {
            $data->slug = str_slug($request->name . '-' . str_random(7));
        }

        if(isset($request->description)) {
            $data->description = $request->description;
        } else {
            $data->description = '–––';
        }

        if(isset($request->color_code)) {
            $data->color_code = $request->color_code;
        } else {
            $data->color_code = null;
        }

        $data->attrb_id = $id;

        $data->save();

        // Log event
        $activity = new Activity;
        $model = 'Product\Attribute';
        $task = 'created new product attribute ' . $request->name;
        $activity->registerActivity($model, $task);

        return back();
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
