<?php

namespace App\Http\Controllers;


use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    public function view(Request $request): \Illuminate\Http\JsonResponse
    {
        ArticleCategory::fixTree();

        $query = ArticleCategory::orderBy("priority");
        if($request->has('except'))
            $query->where("art_category_id", "<>", $request->input('except'));

        return $this->json_response($query->get()->toTree());
    }
}
