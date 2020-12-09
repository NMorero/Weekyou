<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectViews extends Model
{
    public $table = 'PROJECT_VIEWS';

    protected $fillable = [
        'project_id', 'view_id'
    ];
}
