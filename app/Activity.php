<?php

namespace Urban;

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
        return $this->belongsTo('Urban\User', 'user_id');
    }

    /**
     * Registers activity log to database
     * @param  string $model task performde at
     * @param  string $task  task performed
     * @return null
     */
    public function registerActivity($model, $task) {
        $this->create([
            'user_id' => Auth::id(),
            'model' => $model,
            'task' => $task
        ]);
    }
}
