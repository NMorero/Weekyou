<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    public $table = 'COMPANIES';

    protected $fillable = [
        'name', 'cuit', 'alias', 'website', 'administrator_name', 'administrator_email', 'production_manager_name', 'production_email', 'phone_number', 'address', 'postal_code', 'identification_code'
    ];
}
