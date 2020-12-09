<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliveries extends Model
{
    public $table = 'DELIVERIES';

    protected $fillable = [
      'comment', 'type', 'client_id', 'project_id', 'view_id', 'template_id'
    ];
}
