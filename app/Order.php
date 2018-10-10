<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $fillable = [
        'user_id',
        'order_no',
        'bill_email',
        'bill_name',
        'bill_phone',
        'bill_address1',
        'bill_address2',
        'bill_town_city',
        'bill_province_state',
        'bill_country',
        'bill_postcode',
        'bill_name_on_card',
        'bill_subtotal',
        'bill_tax',
        'bill_total',
        'payment_method',
        'shipped',
        'error'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
