<?php

namespace Urban;

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
        return $this->hasMany('Urban\Media', 'dir_id');
    }
}
