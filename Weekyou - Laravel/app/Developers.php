<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Developers extends Model
{
    public $table = 'DEVELOPERS';


    public function person()
    {
        return $this->belongsTo('App\Persons', 'person_id');
    }
}
