<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectLeaders extends Model
{
    public $table = 'PROJECT_LEADERS';


    public function LDevelopers()
    {
        return $this->hasMany('App\LeaderOfDeveloper', 'leader_id');
    }
}
