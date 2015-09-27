<?php namespace App\Repositories;

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
		$a->answer = $input['answer'];
		$a->question_id = $input['question_id'];
		$a->user_id = auth()->user()->id;
		$a->save();

		return $a;
	}

	public function delete($id)
	{
		if($q = Answer::find($id))
		{
			return $q->delete();
		}

		return false;
	}

	public function verifyPoints($answer)
	{
		return (bool) ! $answer->points()->first();
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