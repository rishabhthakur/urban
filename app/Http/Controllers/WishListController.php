<?php

namespace Urban\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Urban\Product;
use Urban\Profile;
use Urban\Adata;
use Urban\User;
use Cart;

class WishListController extends Controller {
    public $user;
    private $wishlist;

    public function __construct() {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->wishlist = app('wishlist')->session(Auth::id());
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function getData($attributes) {
        $attrbs = array();
        foreach ($attributes as $attribute) {
            $data = Adata::find($attribute);
            array_push($attrbs, $data->attribute->name .': '. $data->name);
        }
        return $attrbs;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id) {
        $product = Product::find($id);

        if (!$this->wishlist->isEmpty()) {
            $items = $this->wishlist->getContent();
            foreach ($items as $item) {
                if ($item->attributes->toArray() === $this->getData($request['attributes'])) {
                    return redirect()->back()->with([
                        'info' => 'Item already in your Wish list.'
                    ]);
                }
            }
        }

        if($product->sale_price) {
            $price = $product->sale_price;
        } else {
            $price = $product->regular_price;
        }

        $this->wishlist->add([
            'id' => uniqid(),
            'p_id' => $product->id,
            'name' => $product->name,
            'price' => $price,
            'quantity' => 1,
            'attributes' => $this->getData($request['attributes'])
        ]);

        return redirect()->back()->with([
            'success' => 'Item added to wish list.'
        ]);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function addToCart($id) {
        $item = $this->wishlist->get($id);

        Cart::add([
            'id' => $item->id,
            'p_id' => $item->p_id,
            'name' => $item->name,
            'price' => $item->price,
            'quantity' => $item->quantity,
            'attributes' => $item->attributes->toArray()
        ]);

        $this->wishlist->remove($id);

        return back()->with([
            'success' => ' Item added to cart.'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
