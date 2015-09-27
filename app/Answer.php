<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['points'];

    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function points()
    {
        return $this->belongsToMany('App\User', 'answers_points_user', 'answer_id', 'user_id')->withTimestamps();
    }
}
