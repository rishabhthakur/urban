<?php

namespace App;

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
        return $this->belongsTo('App\Attribute', 'attrb_id');
    }
}
