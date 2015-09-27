<?php

namespace App\Policies;

use App\User;
use App\Answer;

class AnswerPolicy
{
    public function update(User $user, Answer $answer)
    {
        return $user->owns($answer);
    }
}
