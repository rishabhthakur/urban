<?php

namespace Urban\Http\Controllers;

use Urban\Order;
use Illuminate\Http\Request;

class OrderController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.sales.orders.index')->with([
            'orders' => Order::orderBy('created_at', 'DESC')->get()
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
     * @param  \Urban\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order, $id) {
        return view('admin.sales.orders.show')->with([
            'order' => Order::where('order_no', $id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Urban\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Urban\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Urban\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
