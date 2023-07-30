<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected function json_response($data, $message = 0, $code = 0){
        return response(json_encode([
            'data' => $data,
            'message' => $message,
            'code'=> $code
        ]));
    }
}
