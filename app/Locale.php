<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model {

    protected $table = 'locales';

    protected $fillable = [
        'name',
        'code'
    ];
}
