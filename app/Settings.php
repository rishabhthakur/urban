<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model {

    protected $fillable = [
        'status',
        'site_name',
        'tagline',
        'copyright',
        'copyright_text',
        'author',
        'email',
        'description',
        'drole',
        'membrship',
        'privacy',
        'legal'
    ];

    public function drole() {
        return $this->hasOne('Urban\Role');
    }
}
