<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileSystem extends Model {

    protected $table = 'file_systems';

    protected $fillable = [
        'name',
        'url',
        'slug',
        'path'
    ];

    public function medias() {
        return $this->hasMany('App\Media', 'dir_id');
    }
}
