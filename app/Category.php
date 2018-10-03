<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    public $with = [
        'children'
    ];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'belongs_to'
    ];

    public function parent() {
        return $this->belongsTo('Urban\Category', 'parent_id');
    }

    public function children() {
        return $this->hasMany('Urban\Category', 'parent_id');
    }

    public function products() {
        return $this->belongsToMany('Urban\Product');
    }

    public function posts() {
        return $this->belongsToMany('Urban\Post');
    }
}
