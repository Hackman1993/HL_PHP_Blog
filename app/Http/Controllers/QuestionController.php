<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function list(Request $request){
        $query = Question::query();
        return $this->json_response($query->paginate());
    }
    public function create(Request $request)
    {
        return $this->json_response(Question::create($request->input()));
    }

    public function update(Request $request, Question $target)
    {
        $target->update($request->input());
        return $this->json_response($request);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'ids' => 'array|required'
        ]);
        Question::whereIn('question_id', $request['ids'])->delete();
        return $this->json_response();
    }
}
