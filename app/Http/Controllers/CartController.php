<?php
namespace Urban\Http\Controllers;

use Illuminate\Http\Request;
use Urban\Product;
use Cart;

use Urban\Adata;

class CartController extends Controller {

    public $duplicate;

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

        if (!Cart::isEmpty()) {
            $items = Cart::getContent();
            foreach ($items as $item) {
                // dd($item->attributes->toArray(), $this->getData($request['attributes']));
                if ($item->attributes->toArray() === $this->getData($request['attributes'])) {
                    $this->quickUpdate($request, $item->id);
                    return redirect()->back()->with([
                        'success' => 'Cart updated.'
                    ]);
                }
            }
        }

        if($product->sale_price) {
            $price = $product->sale_price;
        } else {
            $price = $product->regular_price;
        }

        $cartItem = Cart::add([
            'id' => uniqid(),
            'p_id' => $product->id,
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

        return redirect()->back()->with([
            'success' => 'Item added to cart.'
        ]);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function save($id) {

        $item = Cart::get($id);

        $saveForLater = app('saveForLater');

        if (!$saveForLater->isEmpty()) {
            $list = $saveForLater->getContent();
            foreach ($list as $listItem) {
                // dd($item->attributes->toArray(), $this->getData($request['attributes']));
                if ($listItem->attributes->toArray() === $item->attributes->toArray()) {
                    $this->quickUpdateSave($item, $listItem->id);
                    Cart::remove($id);
                    return redirect()->back()->with([
                        'success' => 'Cart updated.'
                    ]);
                }
            }
        }

        Cart::remove($id);

        $saveForLater->add([
            'id' => $item->id,
            'p_id' => $item->p_id,
            'name' => $item->name,
            'price' => $item->price,
            'quantity' => $item->quantity,
            'attributes' => $item->attributes->toArray()
        ]);

        return back()->with([
            'success' => ' Item saved for later.'
        ]);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function restore_save($id) {
        $item = app('saveForLater')->get($id);
        app('saveForLater')->remove($id);
        Cart::add([
            'id' => $item->id,
            'p_id' => $item->p_id,
            'name' => $item->name,
            'price' => $item->price,
            'quantity' => $item->quantity,
            'attributes' => $item->attributes->toArray()
        ]);

        return back()->with([
            'success' => ' Item added to cart.'
        ]);
    }

    public function remove_save($id) {
        app('saveForLater')->remove($id);

        return back()->with([
            'success' => ' Item saved for later.'
        ]);
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
    public function quickUpdateSave($item, $id) {
        app('saveForLater')->update($id, array(
            'quantity' => $item->quantity,
        ));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function quickUpdate(Request $request, $id) {
        if (isset($request->quantity)) {
            $quantity = $request->quantity;
        } else {
            $quantity = 1;
        }

        Cart::update($id, array(
            'quantity' => $quantity,
        ));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id) {
        if (isset($request->quantity)) {
            $quantity = $request->quantity;
        } else {
            $quantity = 1;
        }

        Cart::update($id, array(
            'quantity' => $quantity,
        ));

        return redirect()->back()->with([
            'success' => 'Cart updated.'
        ]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function updateJson(Request $request, $rowId) {
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
    public function destroy($id) {
        Cart::remove($id);
        return redirect()->back()->with([
            'success' => 'Item removed from cart.'
        ]);
    }
}
