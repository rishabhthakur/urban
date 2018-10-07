<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;

class Messagereplies extends Model {

    protected $fillable = [
        'message',
        'message_id'
    ];

    /**
     * [user description]
     * @return [type] [description]
     */
    public function message() {
        $this->belongsTo('Urban\Message');
    }
}
