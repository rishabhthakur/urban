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
        $this->hasMany('Urban\Message', 'user_id');
    }

    /**
     * [products description]
     * @return [type] [description]
     */
    public function products() {
        $this->hasMany('Urban\Product');
    }

    /**
     * [products description]
     * @return [type] [description]
     */
    public function posts() {
        $this->hasMany('Urban\Post');
    }

    /**
     * [orders description]
     * @return [type] [description]
     */
    public function orders() {
        $this->hasMany('Urban\Order');
    }

    /**
     * [subscription description]
     * @return [type] [description]
     */
    public function subscription() {
        $this->hasOne('Urban\Newsletter');
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
