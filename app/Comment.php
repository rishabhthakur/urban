<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model {

    use SoftDeletes;

    protected $dates = [
        'deteled_at'
    ];

    protected $fillable = [
        'email',
        'name',
        'content',
        'user_id',
        'post_id',
        'approved',
        'content'
    ];

    public function post() {
        return $this->belongsTo('Urban\Post');
    }
}
