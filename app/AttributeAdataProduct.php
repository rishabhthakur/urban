<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeAdataProduct extends Model {

    protected $table = 'attribute_adata_product';

    protected $fillable = [
        'attribute_id',
        'adata_id',
        'product_id'
    ];

    public function product() {
        return $this->belongsToMany('App\Product');
    }
}
