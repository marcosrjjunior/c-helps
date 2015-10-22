<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;
use App\Http\Requests\QuestionRequest;

class UsersController extends Controller
{
    private $items;

    public function __construct(UserRepositoryInterface $items)
    {
        $this->items = $items;
    }

    public function show($user)
    {
        $user = $this->items->find($user);

        return view('users.show', compact('user'));
    }

}
