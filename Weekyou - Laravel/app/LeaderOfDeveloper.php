<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaderOfDeveloper extends Model
{
    public $table = 'LEADERS_OF_DEVELOPERS';


    public function developer()
    {
        return $this->belongsTo('App\Developers', 'developer_id', 'id');
    }
}
