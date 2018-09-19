<?php

namespace App;

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
        return $this->belongsTo('App\User');
    }

    public function products() {
        return $this->belongsToMany('App\Product');
    }

    public function posts() {
        return $this->bolongsToMany('App\Post');
    }

    public function directory() {
        return $this->belongsTo('App\FileSystem', 'dir_id');
    }
}
