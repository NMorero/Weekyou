<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedbacks extends Model
{
    public $table = 'FEEDBACKS';

    protected $fillable = [
        'message', 'client_id', 'project_id', 'view_id', 'developer_id'
    ];
}
