<?php

namespace App\Http\Controllers;

use App\Stag;
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
            'route' => 'admin.products.tags.store'
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stag  $stag
     * @return \Illuminate\Http\Response
     */
    public function show(Stag $stag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stag  $stag
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
     * @param  \App\Stag  $stag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stag $stag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stag  $stag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stag $stag)
    {
        //
    }
}
