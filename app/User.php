<?php

namespace Urban;

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
        'subscription',
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
        return $this->hasOne('Urban\Profile', 'user_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function role() {
        return $this->belongsTo('Urban\Role', 'role_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function medias() {
        return $this->hasOne('Urban\Media', 'user_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function activities() {
        return $this->hasMany('Urban\Activity', 'user_id');
    }

    /**
     * [user description]
     * @return [type] [description]
     */
    public function messages() {
        return $this->hasMany('Urban\Message', 'user_id');
    }

    /**
     * [products description]
     * @return [type] [description]
     */
    public function products() {
        return $this->hasMany('Urban\Product', 'user_id');
    }

    /**
     * [products description]
     * @return [type] [description]
     */
    public function reviews() {
        return $this->hasMany('Urban\Review');
    }

    /**
     * [orders description]
     * @return [type] [description]
     */
    public function orders() {
        return $this->hasMany('Urban\Order');
    }

    /**
     * [products description]
     * @return [type] [description]
     */
    public function posts() {
        return $this->hasMany('Urban\Post');
    }

    /**
     * [products description]
     * @return [type] [description]
     */
    public function comments() {
        return $this->hasMany('Urban\Comment');
    }

    /**
     * [subscription description]
     * @return [type] [description]
     */
    public function subscription() {
        return $this->hasOne('Urban\Newsletter');
    }

    /**
     * [subscription description]
     * @return [type] [description]
     */
    public function addresses() {
        return $this->hasMany('Urban\Address');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function getNameAttribute($name) {
        return ucwords($name);
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
