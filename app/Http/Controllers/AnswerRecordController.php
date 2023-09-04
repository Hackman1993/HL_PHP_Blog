<?php

namespace App\Http\Controllers;

use App\Models\AnswerRecord;
use Illuminate\Http\Request;

class AnswerRecordController extends Controller
{
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        if(AnswerRecord::where([
                'name' => $request['name'],
                'phone' => $request['phone']
            ])->count() > 0) {
            $this->json_response(AnswerRecord::where([
                'name' => $request['name'],
                'phone' => $request['phone']
            ])->update(['score' => $request['score']]));
            return $this->json_response(AnswerRecord::where([
                'name' => $request['name'],
                'phone' => $request['phone']
            ])->first());
        }else{
            return $this->json_response(AnswerRecord::create($request->input()));
        }
    }
}
