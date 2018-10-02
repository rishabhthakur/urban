<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model {

    public $with = [
        'data'
    ];

    protected $fillable = [
        'name',
        'slug'
    ];

    public function data() {
        return $this->hasMany('Urban\Adata', 'attrb_id');
    }

    public function products() {
        return $this->belongsToMany('Urban\Product');
    }
}
