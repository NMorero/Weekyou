<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    public $table = 'TASKS';


    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function project(){
        return $this->belongsTo('App\Projects', 'project_id');
    }

    public function client(){
        return $this->belongsTo('App\Clients', 'client_id');
    }
}
