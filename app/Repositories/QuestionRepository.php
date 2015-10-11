<?php namespace App\Repositories;

use App\Question;
use App\Tag;
use Gate;
use Maknz\Slack\Client;

class QuestionRepository implements QuestionRepositoryInterface {

	public function all()
	{
		return Question::all();
	}

	public function find($id)
	{
		return Question::find($id);
	}

	public function byTag($tagId)
	{
		return Tag::find($tagId)->questions;
	}

	public function search($q)
	{
		return Question::where('title', 'LIKE', "%$q%")->get();
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

		$this->slackMessage($q);

		return $q;
	}

	public function update($id, array $input)
	{
		$q = Question::find($id);

		if (Gate::denies('update', $q)) {
			abort(403);
		}

		$q->text = $input['text'];
		$q->save();

		return $q;
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

	public function slackMessage($q)
	{
		$client = new Client(env('SLACK_WEBHOOK_URL'), [
			'username'     => 'c-helps',
			'channel'      => env('SLACK_CHANNEL'),
			'icon'         => env('SLACK_ICON'),
			'unfurl_links' => true,
			'link_names'   => true,
		]);

		$client->to(env('SLACK_TO'))->attach([
		    'fallback'    => 'New question created',
		    'author_name' => $q->title,
		    'author_link' => env('C-HELPS_URL') . '/questions/' . $q->id,
		    'author_icon' => $q->user->avatar,
		    'color'       => '#010167',
		    'pretext'     => 'New question created',
		])->send('');
	}
}