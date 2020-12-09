<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    public $table = 'PROJECTS';

    protected $fillable = [
        'project_name', 'delivery_date', 'client_id', 'manager_id', 'leader_id'
    ];



    public function manager(){
        return $this->belongsTo ('App\ProjectManagers', 'manager_id');
    }

    public function leader(){
        return $this->belongsTo ('App\ProjectLeaders', 'leader_id');
    }
    public function client(){
        return $this->belongsTo('App\Clients', 'client_id}');
    }
    public function views(){
        return $this->hasMany('App\ProjectViews', 'id', 'project_id');
    }

}
