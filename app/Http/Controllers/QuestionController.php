<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function list(Request $request){
        $query = Question::query();
        return $this->json_response($query->paginate());
    }
    public function create(Request $request)
    {
        $request->validate(['option_data' => 'json']);
        $target = new Question($request->input());
        if($request->has('option_data'))
            $target->option_data = json_decode($request['option_data']);
        $target->save();
        return $this->json_response($target);
    }


    public function update(Request $request, Question $target)
    {
        if($request->has('option_data'))
            $target->option_data = json_decode($request['option_data']);
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

    public function getdb(Request $request){
        return $this->json_response(Question::orderBy(DB::raw("RAND()"))->limit(10)->get());
    }
}
