<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stag extends Model {
    
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    public function products() {
        return $this->belongsToMany('App\Product');
    }
}
