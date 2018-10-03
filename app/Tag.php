<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    public function products() {
        return $this->belongsToMany('Urban\Product');
    }

    public function posts() {
        return $this->belongsToMany('Urban\Post');
    }
}
