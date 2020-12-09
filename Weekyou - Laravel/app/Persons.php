<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Persons extends Model
{
    public $table = 'PERSONS';

    public function country()
    {
        return $this->belongsTo('App\Countries', 'country_id');
    }

    public function state()
    {
        return $this->belongsTo('App\States', 'state_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Cities', 'city_id');
    }
}
