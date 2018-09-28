<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model {

    protected $fillable = [
        'user_id',
        'email'
    ];

    /**
     * [subscription description]
     * @return [type] [description]
     */
    public function user() {
        $this->belongsTo('App\User');
    }
}
