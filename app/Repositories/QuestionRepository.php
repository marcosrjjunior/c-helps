<?php namespace App\Repositories;

use App\Question;

class QuestionRepository implements QuestionRepositoryInterface {

	public function all()
	{
		return Question::all();
	}

	public function find($id)
	{
		return Question::find($id);
	}

	public function store($id, array $input)
	{
		return is_null($id) ? $this->create($input) : $this->update($id, $input);
	}

	public function create(array $input)
	{
		$q = new Question;
		$q->title = $input['title'];
		$q->text = $input['text'];
		$q->user_id = auth()->user()->id;
		$q->save();

		return $q;
	}

	public function update($id, array $input)
	{
		$q = Question::find($id);
		$q->name = $input['name'];
		$q->text = $input['text'];
		$q->save();

		return $q;
	}

	public function delete($id)
	{
		if($q = Question::find($id))
		{
			return $q->delete();
		}

		return false;
	}
}