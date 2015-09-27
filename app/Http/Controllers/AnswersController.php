<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepositoryInterface;
use App\Http\Requests\AnswerRequest;

class AnswersController extends Controller
{
    private $items;

    public function __construct(AnswerRepositoryInterface $items)
    {
        $this->items = $items;
    }

    public function submit(AnswerRequest $request)
    {
        $item = $this->items->store($request->id, $request->all());

        session()->flash('flash_message', 'Answer Created!');

        return redirect()->back();
    }

    public function show($id)
    {
        $question = $this->items->find($id);

        return view('answers.show', compact('question'));
    }

    public function submitPoints($id)
    {
        $answer = $this->items->find($id);

        /**
         * Verify if logged user already voted
         */
        if ($this->items->verifyPoints($answer))
        {
            $answer = $this->items->addPoint($answer, request()->input('point'));

            return response($answer, '200');
        }

        return response($answer, '500');
    }

    public function edit($id)
    {
        $answer = $this->items->find($id);

        return view('answers.edit', compact('answer'));
    }

    public function update(AnswerRequest $request)
    {
        $item = $this->items->update($request->id, $request->input());

        return redirect()->route('questions.show', $item->question->id);
    }

    public function delete($id)
    {
        return $this->items->delete($id);
    }

}
