<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationships extends Model
{
    public $table = 'RELATIONSHIP';

    public function freelanceRelation()
    {
        return $this->belongsTo('App\FreelanceRelationships', 'freelance_id');
    }

    public function directRelation()
    {
        return $this->belongsTo('App\DirectRelationships', 'direct_id');
    }
}
