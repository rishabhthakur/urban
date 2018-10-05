<?php

namespace Urban;

use Illuminate\Database\Eloquent\Model;

class Dsettings extends Model {

    protected $fillable = [
        'discussion',
        'discussion_full',
        'discussion_auth',
        'auto_close_discussion',
        'discussion_email',
        'discussion_spam_email',
        'discussion_approve',
        'discussion_approve_once'
    ];
}
