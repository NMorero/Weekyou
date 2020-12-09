<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectManagers extends Model
{
    public $table = 'PROJECT_MANAGERS';




    public function MLeaders()
    {
        return $this->hasMany('App\ManagerOfLeaders', 'manager_id');
    }
}
