<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {

    public $with = [
        'user',
        'directory'
    ];

    protected $fillable = [
        'name',
        'slug',
        'url',
        'size',
        'mime_type',
        'dimensions',
        'dir_id',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('Urban\User');
    }

    public function products() {
        return $this->belongsToMany('Urban\Product');
    }

    public function posts() {
        return $this->bolongsToMany('Urban\Post');
    }

    public function directory() {
        return $this->belongsTo('Urban\FileSystem', 'dir_id');
    }
}
