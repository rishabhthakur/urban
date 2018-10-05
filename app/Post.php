<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {

    use SoftDeletes;

    public $with = [
        //
    ];

    protected $dates = [
        'deteled_at'
    ];

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'media_id',
        'excerpt',
        'slug',
        'user_id',
        'discussion',
        'visibility',
        'status'
    ];

    public function categories() {
        return $this->belongsToMany('Urban\Category');
    }

    public function tags() {
        return $this->belongsToMany('Urban\Tag');
    }

    public function media() {
        return $this->belongsTo('Urban\Media');
    }

    public function user() {
        return $this->belongsTo('Urban\User');
    }
}
