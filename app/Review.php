<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

    protected $fillable = [
        'product_id',
        'user_id',
        'first_name',
        'last_name',
        'content'
    ];

    public function product() {
        return $this->belongsTo('App\Product');
    }
}
