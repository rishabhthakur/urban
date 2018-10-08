<?php
namespace Urban\Http\Controllers;

use Illuminate\Http\Request;
use Urban\Product;
use Cart;

use Urban\Adata;

class CartController extends Controller {

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index() {
        //
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create() {
    }

    public function getData($attributes) {
        foreach ($attributes as $attribute) {
            $data = Adata::find($attribute);
            return $attrbs = [
                $data->attribute->name => $data->name
            ];
        }
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request, $id) {

        $product = Product::find($id);

        if($product->sale_price) {
            $price = $product->sale_price;
        } else {
            $price = $product->regular_price;
        }

        // if(isset($request->qty)) {
        //     $quantity = $request->qty;
        // } else {
        //     $quantity = 1;
        // }

        $cartItem = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $price,
            'quantity' => 1,
            'attributes' => $this->getData($request['attributes'])

        ]);

        // add single condition on a cart bases
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'VAT 12.5%',
            'type' => 'tax',
            'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => '12.5%',
            'attributes' => array( // attributes field is optional
                'description' => 'Value added tax',
                'more_data' => 'more data here'
            )
        ));

        return redirect()->back()->with('success', 'Item added to cart.');
    }

    // public function quick_add($id) {
    //
    //   $product = Product::find($id);
    //   if($product->sale_price) {
    //     $price = $product->sale_price;
    //   } else {
    //     $price = $product->regular_price;
    //   }
    //
    //   $cartItem = Cart::add([
    //     'id' => $product->id,
    //     'name' => $product->name,
    //     'image' => $product->image,
    //     'qty' => 1,
    //     'price' => $price,
    //     'size' => 'M'
    //   ]);
    //
    //   Cart::associate($cartItem->rowId, 'Urban\product');
    //
    //   return redirect()->back();
    // }
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id) {
      //
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id) {
      //
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $rowId) {
        Cart::update($rowId, ['qty' => request()->quantity]);
        session()->flash('success', 'Cart was updated.');
        return response()->json(['success' => true]);
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($rowId) {
        Cart::remove($rowId);
        return redirect()->back()->with('success', 'Item removed from cart.');
    }
}
