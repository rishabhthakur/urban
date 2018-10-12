<?php
namespace Urban\Http\Controllers;

use Illuminate\Http\Request;
use Urban\Product;
use Urban\Adata;
use Cart;
use Urban\Coupon;
use Urban\Jobs\UpdateCoupon;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller {

    public $duplicate;

    public function getData($attributes) {
        $attrbs = array();
        foreach ($attributes as $attribute) {
            $data = Adata::find($attribute);
            array_push($attrbs, $data->attribute->name .': '. $data->name);
        }
        return $attrbs;
    }

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

    public function update(Request $request, $id) {
        Cart::update($id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity
            ),
        ));
        session()->flash('success', 'Cart updated.');
        return response()->json([
            'success' => true
        ], 200);
    }

    public function destroy($id) {
        Cart::remove($id);
        return redirect()->back()->with([
            'success' => 'Item removed from cart.'
        ]);
    }

    /**
     * Include coupon to cart subtotal
     * @param Request $request coupon code
     */
    public function coupon_add(Request $request) {
        $coupon = Coupon::where('code', $request->coupon)->first();
        if (!$coupon) {
            return back()->with([
                'error' => 'Invalid coupon code. Please try again.'
            ]);
        }
        if ($coupon->expire_at >= date("Y-m-d H:i:s")) {
            return back()->with([
                'error' => 'Coupon expired.'
            ]);
        }
        dispatch_now(new UpdateCoupon($coupon));
        return back()->with([
            'success' => 'Coupon has been applied!'
        ]);
    }

    public function coupon_remove() {
        session()->forget('coupon');
        return back()->with([
            'success' => 'Coupon has been removed.'
        ]);
    }
}
