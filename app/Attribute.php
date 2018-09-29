<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model {

    protected $fillable = [
        'name',
        'slug'
    ];

    public function data() {
        return $this->hasMany('App\Adata', 'attrb_id');
    }

    public function products() {
        return $this->belongsToMany('App\Product');
    }
}
