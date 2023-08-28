<?php

namespace App\Http\Controllers;

use App\Models\SignRecord;
use Illuminate\Http\Request;

class SignRecordController extends Controller
{
    public function sign(Request $request){
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string'
        ]);
        if(SignRecord::where([
            'name' => $request['name'],
            'phone' => $request['phone']
        ])->count() > 0){
            return $this->json_response(SignRecord::where([
                'name' => $request['name'],
                'phone' => $request['phone']
            ])->first());
        }else{
            return $this->json_response(SignRecord::create($request->input()));
        }
    }
}
