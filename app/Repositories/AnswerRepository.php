<?php namespace App\Repositories;

use Gate;
use App\Answer;
use App\Http\Traits\HelperTrait;

class AnswerRepository implements AnswerRepositoryInterface {

	use HelperTrait;

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
		$a->text = $this->replaceTags($input['text']);
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

		$a->text = $this->replaceTags($input['text']);
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

	public function updatePoint($answer, $point)
	{
		$points = $answer->points;

		$answer->update([
			'points' => $point == 'up' ? $points + 1 : $points - 1,
		]);

		$answer->points()->attach(auth()->user()->id);

		$answer->user->update([
			'points' => $point == 'up' ? $answer->user->points + 1 : $answer->user->points - 1
		]);

		return $answer;
	}
}