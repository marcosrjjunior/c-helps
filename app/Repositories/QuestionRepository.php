<?php namespace App\Repositories;

use App\Question;
use Gate;

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

		if ($input['tags'])
		{
			$this->saveTags($q, $input['tags']);
		}

		return $q;
	}

	public function update($id, array $input)
	{
		$a = Question::find($id);

		if (Gate::denies('update', $a)) {
			abort(403);
		}

		$a->text = $input['text'];
		$a->save();

		return $a;
	}

	public function saveTags($model, $tags)
	{
		$tags = app('App\Repositories\TagRepositoryInterface')->hasTagsOrCreate($tags);

		$model->tags()->attach($tags);
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