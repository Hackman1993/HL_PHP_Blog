<?php

namespace App\Http\Controllers;

use App\Models\FrontendMenu;
use Illuminate\Http\Request;

class FrontendMenuController extends Controller
{
    public function view(Request $request): \Illuminate\Http\JsonResponse
    {
        FrontendMenu::fixTree();
        return $this->json_response(FrontendMenu::all()->toTree());
    }
}
