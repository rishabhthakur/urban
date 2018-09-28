<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail {

    use Notifiable;

    public $with = [
        'profile',
        'role'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'admin',
        'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function profile() {
        return $this->hasOne('App\Profile', 'user_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function role() {
        return $this->belongsTo('App\Role', 'role_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function medias() {
        return $this->hasOne('App\Media', 'user_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function activities() {
        return $this->hasMany('App\Activity', 'user_id');
    }

    /**
     * [user description]
     * @return [type] [description]
     */
    public function messages() {
        $this->hasMany('App\Message', 'user_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function getCreatedAtAttribute($date) {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function getUpdatedAtAttribute($date) {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
    }
}
