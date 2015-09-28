<?php namespace App\Repositories;

use App\Tag;

class TagRepository implements TagRepositoryInterface {

	public function all()
	{
		return Tag::all();
	}

	public function find($id)
	{
		return Tag::find($id);
	}

	public function create(array $input)
	{
		$a = new Tag;
		$a->name = $input['name'];
		$a->save();

		return $a;
	}

	public function hasTagsOrCreate($data)
	{
		$tags = [];

		foreach ($data as $tag) {
			if ($t = Tag::whereName($tag)->first()) {
				$tags[] = $t->id;
			} else {
				$tags[] = $this->create(['name' => $tag])->id;
			}
		}

		return $tags;
	}

}