<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    public $fillable = [
        'name'
    ];

    public function users() {
        return $this->hasMany('Urban\User', 'role_id');
    }
}
