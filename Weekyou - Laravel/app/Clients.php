<?php

namespace App;
use App\Persons;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    public $table = 'CLIENTS';

    protected $fillable = [
        'type', 'person_id', 'company_id'
    ];

    public function person(){
        return $this->belongsTo('App\Persons', 'person_id');
    }

    public function company(){
        return $this->belongsTo('App\Companies', 'company_id');
    }

}
