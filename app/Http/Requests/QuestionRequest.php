<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class QuestionRequest extends Request {

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|min:7',
            'text'  => 'required|min:10',
            'tags'  => 'required',
        ];
    }

}
