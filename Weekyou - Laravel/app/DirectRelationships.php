<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DirectRelationships extends Model
{
    public $table = 'DIRECT_RELATIONSHIP';


    public function person()
    {
        return $this->belongsTo('App\Persons', 'person_id');
    }
}
