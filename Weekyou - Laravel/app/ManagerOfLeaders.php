<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManagerOfLeaders extends Model
{
    public $table = 'MANAGERS_OF_LEADERS';

    public function leader()
    {
        return $this->belongsTo('App\ProjectLeaders', 'leader_id', 'id');
    }
}
