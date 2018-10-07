<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

    protected $fillable = [
        'address1',
        'address2',
        'town_city',
        'province_state',
        'postcode',
        'country',
        'phone',
        'user_id',
        'type'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
