<?php namespace App\Repositories;

use App\User;

class UserRepository implements UserRepositoryInterface {

	public function all()
	{
		return User::all();
	}

	public function find($id)
	{
		return User::find($id);
	}

}