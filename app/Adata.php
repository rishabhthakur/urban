<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;

class Adata extends Model {

    protected $fillable = [
        'attrb_id',
        'name',
        'slug',
        'description',
        'color_code'
    ];

    public function attribute() {
        return $this->belongsTo('Urban\Attribute', 'attrb_id');
    }

    public function products() {
        return $this->belongsToMany('Urban\Product');
    }
}
