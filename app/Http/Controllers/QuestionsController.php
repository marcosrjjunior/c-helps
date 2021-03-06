<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepositoryInterface;
use App\Repositories\TagRepositoryInterface;
use App\Http\Requests\QuestionRequest;

class QuestionsController extends Controller
{
    private $items;
    private $tags;

    public function __construct(QuestionRepositoryInterface $items, TagRepositoryInterface $tags)
    {
        $this->items = $items;
        $this->tags  = $tags;
    }

    public function ask()
    {
        $tags = $this->tags->all();

        return view('questions.ask', compact('tags'));
    }

    public function index()
    {
        $questions = $this->items->paginate(15);

        return view('index', compact('questions'));
    }

    public function submit(QuestionRequest $request)
    {
        $item = $this->items->store($request->id, $request->all());

        return redirect()->route('questions.show', $item->id)->with('flash_message', 'Question Created!');
    }

    public function show($id)
    {
        $question = $this->items->find($id);

        return view('questions.show', compact('question'));
    }

    public function byTag($tagName)
    {
        $questions = $this->items->byTag($tagName);

        return view('index', compact('questions'));
    }

    public function edit($id)
    {
        $question = $this->items->find($id);
        $tags = $this->tags->all();

        return view('questions.edit', compact('question', 'tags'));
    }

    public function update(QuestionRequest $request)
    {
        $item = $this->items->update($request->id, $request->input());

        return redirect()->route('questions.show', $item->id);
    }

    public function delete($id)
    {
        return $this->items->delete($id);
    }

    public function search()
    {
        $questions = $this->items->search(request()->input('q'));

        return view('index', compact('questions'));
    }
}
