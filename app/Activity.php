<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model {

    public $with = [
        'user'
    ];

    protected $fillable = [
        'user_id',
        'model',
        'task'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
