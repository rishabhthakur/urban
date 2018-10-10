<?php

namespace Urban\Http\Controllers;

use Urban\Coupon;
use App\Jobs\UpdateCoupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        if (!$coupon) {
            return back()->with([
                'error' => 'Invalid coupon code. Please try again.'
            ]);
        }
        dispatch_now(new UpdateCoupon($coupon));
        return back()->with([
            'success' => 'Coupon has been applied!'
        ]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');
        return back()->with([
            'success' => 'Coupon has been removed.'
        ]);
    }
}
