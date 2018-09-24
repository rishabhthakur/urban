<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Activity extends Model {

    public $with = [
        'user'
    ];

    protected $fillable = [
        'user_id',
        'model',
        'task'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function registerActivity($model, $task) {
        $this->create([
            'user_id' => Auth::id(),
            'model' => $model,
            'task' => $task
        ]);
    }
}
