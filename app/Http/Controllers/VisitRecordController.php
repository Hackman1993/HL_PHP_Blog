<?php

namespace App\Http\Controllers;

use App\Models\AnswerRecord;
use App\Models\SignRecord;
use App\Models\VisitRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitRecordController extends Controller
{
    public function visit(Request $request)
    {
        $request->validate([
            'key' => 'required|exists:g_visit_record,key'
        ]);

        DB::transaction(function () use ($request) {
            $record = DB::table('g_visit_record')->where([
                'occur_at' => DB::raw('DATE(NOW())'),
                'key' => $request['key']
            ])->lockForUpdate()->first();
            if ($record) {
                DB::table('g_visit_record')->where([
                    'occur_at' => DB::raw('DATE(NOW())'),
                    'key' => $request['key']
                ])->update(['count' => DB::raw('count+1')]);
            } else {
                DB::table('g_visit_record')->insert([
                    'key' => $request['key'],
                    'count' => 1
                ]);
            }
        });
        return $this->json_response();
    }

    public function statistic()
    {
        $daily_adult_click = VisitRecord::firstOrCreate([
            'key' => 'visit_count.adult',
            'occur_at' => DB::raw('DATE(NOW())'),
            'count'=> 0
        ])['count'];

        $daily_non_adult_click = VisitRecord::firstOrCreate([
            'key' => 'visit_count.non_adult',
            'occur_at' => DB::raw('DATE(NOW())'),
            'count'=> 0
        ])['count'];
        $daily_total_click = $daily_adult_click + $daily_non_adult_click;

        $total_adult_click = VisitRecord::where('key', 'visit_count.adult')->sum('count');
        $total_non_adult_click = VisitRecord::where('key', 'visit_count.non_adult')->sum('count');
        $total_click = $total_adult_click + $total_non_adult_click;

        $daily_answer_record = AnswerRecord::whereDate(DB::raw('DATE(created_at)'), DB::raw('DATE(NOW())'))->count();
        $total_answer_record = AnswerRecord::query()->count();

        $daily_sign_record = SignRecord::whereDate(DB::raw('DATE(created_at)'), DB::raw('DATE(NOW())'))->count();
        $total_sign_record = SignRecord::query()->count();
        return $this->json_response([
            'daily_adult_click' => $daily_adult_click,
            'daily_non_adult_click' => $daily_non_adult_click,
            'daily_total_click' => $daily_total_click,
            'total_adult_click' => $total_adult_click,
            'total_non_adult_click' => $total_non_adult_click,
            'total_click' => $total_click,
            'daily_answer_record' => $daily_answer_record,
            'total_answer_record' => $total_answer_record,
            'daily_sign_record' => $daily_sign_record,
            'total_sign_record' => $total_sign_record
        ]);
    }
}
