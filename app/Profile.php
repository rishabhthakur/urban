<?php

namespace Urban;

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
        return $this->belongsTo('Urban\User', 'user_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function getFirstNameAttribute($first_name) {
        return ucwords($first_name);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function getLastNameAttribute($last_name) {
        return ucwords($last_name);
    }

    /**
     * attach URL to user profile file
     * @param  string
     * @return string URL to user profile file
     */
    public function getAvatarAttribute($avatar) {
        return asset('uploads/avatar/' . strtolower($this->user->name) . '/' . $avatar);
    }
}
