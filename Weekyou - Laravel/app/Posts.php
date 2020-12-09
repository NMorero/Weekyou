<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    public $table = 'POSTS';

    protected $fillable = [
        'title', 'message', 'image_id', 'user_id', 'client_id', 'project_id', 'view_id'
    ];



    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function feedback()
    {
        return $this->belongsTo('App\Feedbacks', 'feedback_id');
    }
}
