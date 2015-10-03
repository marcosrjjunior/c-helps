<?php

namespace App\Policies;

use App\User;
use App\Question;

class QuestionPolicy
{
    public function update(User $user, Question $answer)
    {
        return $user->owns($answer);
    }
}
