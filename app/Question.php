<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function answers()
    {
        return $this->hasMany('App\Answer')
            ->orderBy('points', 'desc');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'question_tags')->withTimestamps();
    }

    public function countPoints()
    {
        $votes = 0;

        foreach($this->answers as $answer)
        {
            $votes += $answer->points;
        }

        return $votes;
    }

    public function countAnswers()
    {
        return count($this->answers);
    }

    public function getTitle()
    {
        return strlen($this->title) > 90 ? substr($this->title, 0, 90).'...' : $this->title;
    }

}
