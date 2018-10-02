<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;

class Scategory extends Model {

    public $with = [
        'children'
    ];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id'
    ];

    public function parent() {
        return $this->belongsTo('Urban\Scategory', 'parent_id');
    }

    public function children() {
        return $this->hasMany('Urban\Scategory', 'parent_id');
    }

    public function products() {
        return $this->belongsToMany('Urban\Product');
    }
}
