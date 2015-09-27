<?php namespace App\Repositories;

use Gate;
use App\Answer;

class AnswerRepository implements AnswerRepositoryInterface {

	public function all()
	{
		return Answer::all();
	}

	public function find($id)
	{
		return Answer::find($id);
	}

	public function store($id, array $input)
	{
		return is_null($id) ? $this->create($input) : $this->update($id, $input);
	}

	public function create(array $input)
	{
		$a = new Answer;
		$a->answer = $input['answer'];
		$a->question_id = $input['question_id'];
		$a->user_id = auth()->user()->id;
		$a->save();

		return $a;
	}

	public function update($id, array $input)
	{
		$a = Answer::find($id);

		if (Gate::denies('update', $a)) {
			abort(403);
		}

		$a->answer = $input['answer'];
		$a->save();

		return $a;
	}

	public function delete($id)
	{
		$a = Answer::find($id);

		if (Gate::denies('update', $a)) {
			abort(403);
		}

		$a->delete();
	}

	public function verifyPoints($answer)
	{
		$user = auth()->user();

		return (bool) ! $answer->points()->whereUserId($user->id)->first() && ($answer->user_id != $user->id);
	}

	public function addPoint($answer, $point)
	{
		$points = $answer->points;

		$answer->update([
			'points' => $point == 'up' ? $points + 1 : $points - 1,
		]);

		$answer->points()->attach(auth()->user()->id);

		return $answer;
	}
}