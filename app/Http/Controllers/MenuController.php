<?php

namespace App\Http\Controllers;

use App\Models\BackendMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function view(Request $request): \Illuminate\Http\JsonResponse
    {
        BackendMenu::fixTree();
        return $this->json_response(BackendMenu::orderByDesc('order')->get()->toTree());
    }
}
