<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    public $table = 'EVENTS';

    protected $fillable = [
      'message', 'end_date', 'client_id', 'project_id', 'view_id'
    ];


    public function client(){
      return $this->belongsTo('App\Clients', 'client_id');
    }

    public function project(){
      return $this->belongsTo('App\Projects', 'project_id');
    }

}
