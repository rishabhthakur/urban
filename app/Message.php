<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    /**
     * [protected description]
     * @var [type]
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'subject',
        'message'
    ];

    /**
     * [user description]
     * @return [type] [description]
     */
    public function user() {
        $this->belongsTo('Urban\User');
    }
}
