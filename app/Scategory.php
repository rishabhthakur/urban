<?php

namespace App;

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
        return $this->belongsTo('App\Scategory', 'parent_id');
    }

    public function children() {
        return $this->hasMany('App\Scategory', 'parent_id');
    }

    public function products() {
        return $this->belongsToMany('App\Product');
    }
}
