<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected function json_response($data = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => "",
            'code' => 0,
            'data' => $data
        ]);
    }
}
