<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model {

    protected $table = 'order_product';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'sale_price',
        'regular_price'
    ];
}
