<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepositoryInterface;
use App\Http\Requests\QuestionRequest;

class QuestionsController extends Controller
{
    private $items;

    public function __construct(QuestionRepositoryInterface $items)
    {
        $this->items = $items;
    }

    public function ask()
    {
        return view('questions.ask');
    }

    public function index()
    {
        $questions = $this->items->all();

        return view('index', compact('questions'));
    }

    public function submit(QuestionRequest $request)
    {
        $item = $this->items->store($request->id, $request->all());

        session()->flash('flash_message', 'Question Created!');

        return redirect()->route('questions.show', $item->id);
    }

    public function show($id)
    {
        $question = $this->items->find($id);

        return view('questions.show', compact('question'));
    }

}
