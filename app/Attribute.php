<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model {

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'color_code'
    ];

    public function parent() {
        return $this->belongsTo('App\Attribute', 'parent_id');
    }

    public function children() {
        return $this->hasMany('App\Attribute', 'parent_id');
    }

    public function products() {
        return $this->belongsToMany('App\Product');
    }
}
