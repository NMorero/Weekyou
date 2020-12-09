<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminders extends Model
{
    public $table = 'REMINDERS';

    protected $fillable = [
        'end_date', 'message', 'user_id'
    ];
}
