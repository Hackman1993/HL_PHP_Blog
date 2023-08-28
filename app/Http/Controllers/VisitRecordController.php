<?php

namespace App\Http\Controllers;

use App\Models\VisitRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitRecordController extends Controller
{
    public function visit(Request $request){
        $request->validate([
            'key' => 'required|exists:g_visit_record,key'
        ]);
        DB::transaction(function () use ($request){
            DB::table('g_visit_record')->where('key', $request['key'])->lockForUpdate()->update([
                'count' => DB::raw('count+1')
            ]);
        });
        return $this->json_response();
    }

    public function statistic(){
        $total_click = VisitRecord::where()
    }
}
