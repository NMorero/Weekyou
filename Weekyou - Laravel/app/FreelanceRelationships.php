<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FreelanceRelationships extends Model


{
    public $table = 'FREELANCE_RELATIONSHIP';
    protected $fillable = ['iva_condition', 'account_bank', 'account_number', 'cbu_number', 'familyContact_name', 'familyContact_phoneNumber', 'familyContact_address'];


    public function person()
    {
        return $this->belongsTo('App\Persons', 'person_id');
    }
}
