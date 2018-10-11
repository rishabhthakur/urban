<?php

use Urban\Product;

/*
 * Still to be worked on
 * Function meant to take array and return one/first key value pair
 */
function productDImage($array) {
    return array_values($array)[0];
}

function checkProductImage($name) {
    return $name && file_exists(public_path('uploads/products/') . $name)
                    ? asset(public_path('uploads/products/') . $name)
                    : asset('img/not-found.jpg');
}

function salePercentage($rprice, $sprice) {
    $perc = (($rprice - $sprice) / $rprice) * 100;
    return number_format($perc);
}

function getProduct($id) {
    return Product::find($id);
}

function getNumbers() {
    $tax = 21 / 100;
    $discount = session()->get('coupon')['discount'] ?? 0;
    $code = session()->get('coupon')['name'] ?? null;
    $newSubtotal = (Cart::getSubtotal() - $discount);
    if ($newSubtotal < 0) {
        $newSubtotal = 0;
    }
    $newTax = $newSubtotal * $tax;
    $newTotal = $newSubtotal * (1 + $tax);

    return collect([
        'tax' => $tax,
        'discount' => $discount,
        'code' => $code,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
    ]);
}
