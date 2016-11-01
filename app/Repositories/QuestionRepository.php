<?php namespace App\Repositories;

use App\Question;
use App\Tag;
use Gate;
use Maknz\Slack\Client;
use App\Http\Traits\HelperTrait;

class QuestionRepository implements QuestionRepositoryInterface {

	use HelperTrait;

	public function all()
	{
		return Question::all();
	}

	public function paginate($perPage)
	{
		return Question::paginate($perPage);
	}

	public function find($id)
	{
		return Question::find($id);
	}

	public function byTag($tagName)
	{
		return Tag::whereName($tagName)->first()->questions;
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
		$q->text = $this->replaceTags($input['text']);
		$q->user_id = auth()->user()->id;
		$q->save();

		if ($input['tags']) {
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

		$q->title = $input['title'];
		$q->text = $this->replaceTags($input['text']);
		$q->save();

		if ($input['tags']) {
			$this->saveTags($q, $input['tags']);
		}

		return $q;
	}

	public function saveTags($model, $tags)
	{
		$tags = app('App\Repositories\TagRepositoryInterface')->hasTagsOrCreate($tags);

		$model->tags()->sync($tags);
	}

	public function delete($id)
	{
		$q = Question::find($id);

		if (Gate::denies('update', $q)) {
			abort(403);
		}

		$q->delete();
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
		    'author_name' => $q->getTitle(),
		    'author_link' => url('/') . '/questions/' . $q->id,
		    'author_icon' => $q->user->avatar,
		    'color'       => '#010167',
		    'pretext'     => 'New question created',
		])->send('');
	}
}