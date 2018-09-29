<?php

namespace App;

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
        return $this->hasMany('App\Adata', 'attrb_id');
    }

    public function products() {
        return $this->hasMany('App\Product');
    }
}
