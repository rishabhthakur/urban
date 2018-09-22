<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaProduct extends Model {

    protected $table = 'media_product';

    protected $fillable = [
        'media_id',
        'product_id'
    ];
}
