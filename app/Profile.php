<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'avatar',
        'bio',
        'location',
        'job'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getAvatarAttribute($avatar) {
        return asset($avatar);
    }
}
